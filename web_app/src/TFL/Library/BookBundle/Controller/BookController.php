<?php
namespace TFL\Library\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TFL\Library\BookBundle\Entity\Book;
use TFL\Library\BookBundle\Entity\BookOwner;
use TFL\Library\BookBundle\Util\GoogleBookSearch;
use FOS\UserBundle\Model\UserInterface;
use TFL\Library\UserBundle\Entity\Borrow;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
	/**
	 * @Route("/display/{isbn}", name="book_display")
	 * @Template()
	 */
	public function displayAction($isbn)
	{
		//find book by isbn in DB first
		$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:Book');
		$book = $repository->findOneByIsbn($isbn);
		if($book)
		{
			$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:BookOwner');
			$book_owners = $repository->findByBookId($book->getId());
		}
		else
		{
			$book_owners = FALSE;
			$googleBook = new GoogleBookSearch();
			$book_array = $googleBook->getBookByISBN($isbn);
			//TODO handle book not found
			$book_array['isbn'] = $isbn;
			$book = $book_array;
		}
		
		return array('book_owners' => $book_owners, 'book' => $book);
	}

	
	/**
	 * @Route("/search", name="book_search")
	 * @Template()
	 */
	public function searchAction(Request $request)
	{
		$book = null;
		$book_array = null;
		$book_not_found = false;
		$defaultData = array('search_type' => 'isbn');

		$form = $this->createFormBuilder($defaultData)
			->add('isbn', 'text')
			->add('search_type', 'hidden')
			->getForm();

		$defaultData['search_type'] = 'keywords';
		$keywords_form = $this->createFormBuilder($defaultData)
			->add('keywords', 'text')
			->add('search_type', 'hidden')
			->getForm();

		if ($request->getMethod() == 'POST') 
		{
			$form_data = $request->get('form');

			$googleBook = new GoogleBookSearch();
			if ($form_data['search_type'] == 'isbn') 
			{
				$form->bindRequest($request);
				$book = $googleBook->getBookByISBN($form_data['isbn']);
			}
			else
			{
				$keywords_form->bindRequest($request);
				$book_array = $googleBook->getBooksByKeyword( $form_data['keywords'] );
			}
			if(!$book || !$book_array)
			{
				$book_not_found = true;
			}
		}

		return array(
			'form' => $form->createView(), 
			'keywords_form' => $keywords_form->createView(), 
			'book' => $book, 
			'book_array' => $book_array,
			'book_not_found' => $book_not_found
		);
	}

	
    
	/**
	 * @Route("/new/{isbn}", name="add_to_library")
	 * @Template()
	 */
	public function createAction($isbn)
	{
		$user = $this->container->get('security.context')->getToken()->getUser();
		if (!is_object($user) || !$user instanceof UserInterface) {
			throw new AccessDeniedException('This user does not have access to create a new book.');
		}

		//find book by isbn in DB first
		$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:Book');
		$book = $repository->findOneByIsbn($isbn);

		if(!$book)
		{
			$googleBook = new GoogleBookSearch();
			$book_array = $googleBook->getBookByISBN($isbn);
	
			if( !$book_array )
			{
				//TODO handle book not found
				return array('isbn' => "no isbn", 'title' => "so no book", 'user' => $user->getUsername() );
			}
			
			$book = new Book();
			$book->setIsbn($isbn);
			$book->setTitle($book_array['title']);
			$book->setAuthor($book_array['author']);
			//TODO save image locally, rather than the google link
			$book->setImage($book_array['image']);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($book);
			$em->flush();
		}
		
		$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:BookOwner');
		$book_owner = $repository->findOneBy(array('userId' => $user->getId(), 'bookId' => $book->getId()));
		if($book_owner)
		{
			//TODO handle user owning 2 copies of the same book
			return array('isbn' => $isbn, 'title' => $book_owner->getOwner()->getUsername() . " already has a copy of this book", 'user' => $book_owner->getOwner()->getUsername() );
		}

		$book_owner = new BookOwner();
		$book_owner->setBook($book);
		$book_owner->setOwner($user);
		
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($book_owner);
		$em->flush();

		return array('isbn' => $isbn, 'title' => $book->getTitle(), 'user' => $book_owner->getOwner()->getUsername() );
	}
	
	/**
	 * Id needed is the ID field of the book_owner table
	 * 
	 * @Route("/borrow/{book_owner_id}", name="borrow_book")
	 * @Template()
	 */
	public function borrowAction($book_owner_id)
	{
		$user = $this->container->get('security.context')->getToken()->getUser();
		//TODO handle user doesn't have access to borrow book
		if (!is_object($user) || !$user instanceof UserInterface) {
			throw new AccessDeniedException('This user does not have access to borrow a book.');
		}
		
		$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:BookOwner');
		$book_owner = $repository->findOneById($book_owner_id);
		
		//handle book not found in DB
		if(!$book_owner)
		{
			$problem = 'This book was not found';
			return $this->render(
				'TFLLibraryBookBundle:Book:borrowError.html.twig', 
				array('problem' => $problem, 'problem_data' => $book_owner_id)
			);
		}

		//handle not borrowing your own book
		if($book_owner->getOwner()->getId() == $user->getId())
		{
			$problem = 'You cannot borrow your own book';
			return $this->render(
				'TFLLibraryBookBundle:Book:borrowError.html.twig',
				array('problem' => $problem, 'problem_data' => $book_owner->getBook()->getTitle()) 
			);
		}

		//handle owner has "deleted" book
		if($book_owner->getIsDeleted())
		{
			$problem = 'This person doesn\'t own this book any more';
			return $this->render(
				'TFLLibraryBookBundle:Book:borrowError.html.twig',
				array('problem' => $problem, 'problem_data' => $book_owner->getBook()->getTitle()) 
			);
		}
		
		//check if book is already borrowed
		$repository = $this->getDoctrine()->getRepository('TFLLibraryUserBundle:Borrow');
		$borrowed_item = $repository->findOneBy(array(
				'itemId' => $book_owner->getBook()->getId(), 
				'returned' => 0, 
			));
		if($borrowed_item)
		{
			$problem = 'This book is already borrowed';
			return $this->render(
				'TFLLibraryBookBundle:Book:borrowError.html.twig',
				array('problem' => $problem, 'problem_data' => $borrowed_item->getBorrowedBy()->getUsername())
			);
		}
		
		$borrowed_item = new Borrow();
		$borrowed_item->setItemId($book_owner->getBook()->getId());
		$borrowed_item->setBorrowedDate(new \DateTime("now"));
		$borrowed_item->setBorrowedBy($user);
		
		
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($borrowed_item);
		$em->flush();
		
		
		return array('borrowed_item' => $borrowed_item, 'book_borrowed' => $book_owner);
	}
}
