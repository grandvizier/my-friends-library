<?php
namespace TFL\Library\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TFL\Library\BookBundle\Entity\Book;
use TFL\Library\BookBundle\Entity\BookSearch;
use TFL\Library\BookBundle\Util\GoogleBookSearch;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
	/**
	 * @Route("/title/{title}", name="book_display")
	 * @Template()
	 */
	public function indexAction($title)
	{
		if( is_numeric($title) )
		{
			$book = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:Book')->find($title);

			if (!$book) {
				throw $this->createNotFoundException('No book found for id '.$title);
			}
        	
			return array('book_title' => $book->getTitle());
		}
		else
		{
			return array('book_title' => $title);
		}
	}
    
	/**
	 * @Route("/search", name="book_search")
	 * @Template()
	 */
	public function searchAction(Request $request)
	{
		$book = null;
		$book_array = null;
		$defaultData = array('search_type' => 'keywords');
    	
		$form = $this->createFormBuilder($defaultData)
			->add('isbn', 'text')
			->add('keywords', 'text')
			->add('search_type', 'hidden')
			->getForm();
    	
		if ($request->getMethod() == 'POST') 
		{
			$form->bindRequest($request);
			$form_data = $form->getData();
			$googleBook = new GoogleBookSearch();
			if ($form_data['search_type'] == 'isbn') 
			{
				$book = $googleBook->getBookByISBN($form_data['isbn']);
			}
			else
			{
				$book_array = $googleBook->getBooksByKeyword( $form_data['keywords'] );
			}
			var_dump($book_array);
		}
    	
		return array('form' => $form->createView(), 'book' => $book, 'book_array' => $book_array);
	}

    
	/**
	 * @Route("/new/{isbn}")
	 * @Template()
	 */
	public function createAction($isbn)
	{
		$user = $this->container->get('security.context')->getToken()->getUser();
		if (!is_object($user) || !$user instanceof UserInterface) {
			throw new AccessDeniedException('This user does not have access to create a new book.');
		}
    	
		$googleBook = new GoogleBookSearch();
		$book_array = $googleBook->getBookByISBN($isbn);

		if( $book_array )
		{
			$book = new Book();
			$book->setTitle($book_array['title']);
			$book->setAuthor($book_array['author']);
			$book->setImage($book_array['image']);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($book);
			$em->flush();
		}
		else
		{
			//TODO handle book not found
			return array('isbn' => "no isbn", 'google_books' => "so no book", 'user' => print_r($user, true));
		}
		
		return array('isbn' => $isbn, 'google_books' => print_r($book, true), 'user' => print_r($user, true));
	}
}
