<?php
namespace TFL\Library\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\UserBundle\Model\UserInterface;

class HomeController extends Controller
{
	/**
	 * @Route("/")
	 * @Template("TFLLibraryUserBundle:UserLibrary:completeLibrary.html.twig")
	 */
	public function homepageAction()
	{
		//if not logged in, show form
		$user = $this->container->get('security.context')->getToken()->getUser();
		if (!is_object($user) || !$user instanceof UserInterface) {
			return $this->redirect($this->generateUrl('fos_user_security_login'));
		}
		
		//else displat complete library
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
			'SELECT DISTINCT b, count(b.id) FROM TFLLibraryBookBundle:UserBook b WHERE b.isDeleted = :deleted GROUP BY b.bookId'
		)->setParameter('deleted', '0');
		$books = $query->getResult();
		
		return array('books' => $books);
	}
}
