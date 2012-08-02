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
	 * @Template()
	 */
	public function indexAction()
	{
		$user = $this->container->get('security.context')->getToken()->getUser();
		if (!is_object($user) || !$user instanceof UserInterface) {
			throw new AccessDeniedException('This user does not have access to view their own library.');
		}
		
		$repository = $this->getDoctrine()->getRepository('TFLLibraryBookBundle:UserBook');
		$books = $repository->findByUserId($user->getId());
		
		return array('book_owners' => $books);
	}	
	
	/**
	 * @Route("/full_library", name="full_library")
	 * @Template()
	 */
	public function completeLibraryAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
			'SELECT DISTINCT b, count(b.id) FROM TFLLibraryBookBundle:UserBook b WHERE b.isDeleted = :deleted GROUP BY b.bookId'
		)->setParameter('deleted', '0');
		$books = $query->getResult();
		
		return array('books' => $books);
	}
}