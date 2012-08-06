<?php
namespace TFL\Library\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TFL\Library\BookBundle\Entity\Book;
use TFL\Library\BookBundle\Entity\UserBook;
use TFL\Library\BookBundle\Util\GoogleBookSearch;
use FOS\UserBundle\Model\UserInterface;
use TFL\Library\UserBundle\Entity\BorrowBook;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
	/**
	 * @Route("/display/{isbn}", name="book_display")
	 * @Template()
	 */
	public function displayAction($isbn)
	{
		$book = FALSE;
		$books_in_library = FALSE;
		$borrowed = FALSE;
		$user = $this->container->get('security.context')->getToken()->getUser();
		
		//find book by isbn in DB first
		$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:Book');
		$book = $repository->findOneByIsbn($isbn);
		if($book)
		{
			$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:UserBook');
			$book_owners = $repository->findByBookId($book->getId());
			
			//for each book_owner 
			if($book_owners)
			{
				foreach($book_owners as $user_book)
				{
					//check if book is borrowed
					$repository = $this->getDoctrine()->getRepository('TFLLibraryUserBundle:BorrowBook');
					$borrowed = $repository->findOneBy(array('itemId' => $user_book->getId(), 'returned' => 0));
					
					$user_is_owner = ($user->getId() == $user_book->getOwner()->getId()) ? TRUE : FALSE;
					
					$books_in_library[] = array(
						'book_owner' => 	$user_book,
						'borrowed' => 	$borrowed,
						'user_is_owner' => 	$user_is_owner,
					);
				}
			}
		
		}
		else
		{
			$googleBook = new GoogleBookSearch();
			$book_array = $googleBook->getBookByISBN($isbn);
			//TODO handle book not found
			$book_array['isbn'] = $isbn;
			$book = $book_array;
		}
		
		return array('books_in_library' => $books_in_library, 'book' => $book);
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
		
		$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:UserBook');
		$book_owner = $repository->findOneBy(array('userId' => $user->getId(), 'bookId' => $book->getId()));
		if($book_owner)
		{
			//TODO handle user owning 2 copies of the same book
			return array('isbn' => $isbn, 'title' => $book_owner->getOwner()->getUsername() . " already has a copy of this book", 'user' => $book_owner->getOwner()->getUsername() );
		}

		$user_book = new UserBook();
		$user_book->setBook($book);
		$user_book->setOwner($user);
		
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($user_book);
		$em->flush();

		return array('isbn' => $isbn, 'title' => $book->getTitle(), 'user' => $user_book->getOwner()->getUsername() );
	}
	
	/**
	 * 
	 * @Route("/borrow/{user_book_id}", name="borrow_book")
	 * @Template()
	 */
	public function borrowAction($user_book_id)
	{
		$user = $this->container->get('security.context')->getToken()->getUser();
		//handle user doesn't have access to borrow book
		if (!is_object($user) || !$user instanceof UserInterface) {
			throw new AccessDeniedException('This user does not have access to borrow a book.');
		}
		
		$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:UserBook');
		$user_book = $repository->findOneById($user_book_id);
		
		//handle book not found in DB
		if(!$user_book)
		{
			$problem = 'This book was not found';
			return $this->render(
				'TFLLibraryBookBundle:Book:borrowError.html.twig', 
				array('problem' => $problem, 'problem_data' => $user_book_id)
			);
		}

		//handle borrowing your own book (as in you can't)
		if($user_book->getOwner()->getId() == $user->getId())
		{
			$problem = 'You cannot borrow your own book';
			return $this->render(
				'TFLLibraryBookBundle:Book:borrowError.html.twig',
				array('problem' => $problem, 'problem_data' => $user_book->getBook()->getTitle()) 
			);
		}

		//handle owner has "deleted" book
		if($user_book->getIsDeleted())
		{
			$problem = 'This person doesn\'t own this book any more';
			return $this->render(
				'TFLLibraryBookBundle:Book:borrowError.html.twig',
				array('problem' => $problem, 'problem_data' => $user_book->getBook()->getTitle()) 
			);
		}
		
		//check if book is already borrowed
		$repository = $this->getDoctrine()->getRepository('TFLLibraryUserBundle:BorrowBook');
		$borrowed_book = $repository->findOneBy(array(
				'itemId' => $user_book->getId(), 
				'returned' => 0, 
			));
		if($borrowed_book)
		{
			$problem = 'This book is already borrowed';
			return $this->render(
				'TFLLibraryBookBundle:Book:borrowError.html.twig',
				array('problem' => $problem, 'problem_data' => $borrowed_book->getBorrowedBy()->getUsername())
			);
		}
		
		$borrowed_book = new BorrowBook();
		$borrowed_book->setItemId($user_book);
		$borrowed_book->setBorrowedDate(new \DateTime("now"));
		$borrowed_book->setBorrowedBy($user);
		
		
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($borrowed_book);
		$em->flush();
		
		//TODO - only need on parameter passed
		return array('borrowed_book' => $borrowed_book, 'book_borrowed' => $user_book);
	}
}
