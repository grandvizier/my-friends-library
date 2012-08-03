<?php
namespace TFL\Library\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TFL\Library\BookBundle\Entity\Book;
use TFL\Library\BookBundle\Entity\UserBook;
use FOS\UserBundle\Model\UserInterface;

class UserLibraryController extends Controller
{
	/**
	 * @Route("/profile/my_library", name="my_library")
	 * @Template("TFLLibraryUserBundle:UserLibrary:usersLibrary.html.twig")
	 */
	public function indexAction()
	{
		$user = $this->container->get('security.context')->getToken()->getUser();
		if (!is_object($user) || !$user instanceof UserInterface) {
			throw new AccessDeniedException('This user does not have access to view their own library.');
		}
		
		$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:UserBook');
		$books = $repository->findByUserId($user->getId());
		
		$books_borrowed = $this->get_books_user_has($user->getId());
		
		return array('user' => $user, 'books_owned' => $books, 'books_borrowed' => $books_borrowed);
	}	
	
	/**
	 * @Route("/profile/{username}", name="their_library")
	 * @Template()
	 */
	public function usersLibraryAction($username)
	{
		$repository = $this->getDoctrine()->getRepository('TFLLibraryUserBundle:User');
		$user = $repository->findOneByUsername($username);
		if (!is_object($user) || !$user instanceof UserInterface) {
			throw new AccessDeniedException('This user does not have a library.');
		}
		
		$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:UserBook');
		$books = $repository->findByUserId($user->getId());
		
		$books_borrowed = $this->get_books_user_has($user->getId());

		return array('user' => $user, 'books_owned' => $books, 'books_borrowed' => $books_borrowed);
	}
	
	
	private function get_books_user_has($user_id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
				'SELECT ub as user_book
				FROM TFLLibraryBookBundle:UserBook ub
				LEFT JOIN ub.borrowings bub WITH bub.returned = 0
				WHERE ub.isDeleted = :deleted
				AND bub.borrowedBy = :user_id'
		)->setParameter('deleted', '0')->setParameter('user_id', $user_id);
		return $query->getResult();
	}
}