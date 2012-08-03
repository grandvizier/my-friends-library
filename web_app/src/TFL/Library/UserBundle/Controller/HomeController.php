<?php
namespace TFL\Library\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\UserBundle\Model\UserInterface;
use TFL\Library\BookBundle\Entity\UserBook;

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
			'SELECT ub as user_book, bub.returned as returned, us.id as current
				FROM TFLLibraryBookBundle:UserBook ub 
				LEFT JOIN ub.borrowings bub WITH bub.returned = 0
				LEFT JOIN bub.borrowedBy us
				WHERE ub.isDeleted = :deleted'
		)->setParameter('deleted', '0');
		$books = $query->getResult();
		
		$book_array = array();
//var_dump(gettype($books));		
		foreach($books as $db_array)
		{
			$book_id = 0;
			foreach($db_array as $key => $val)
			{
				if ($key == 'user_book' && $val instanceof UserBook) {
					$book_id = $val->getBookId();
					if(isset($book_array[$book_id]))
					{
						$book_array[$book_id]['count'] ++;
					}
					else
					{
						$book_array[$book_id] = array(
							'count' => 1,
							'book' => $val->getBook(),
							'book_owner' => $val->getOwner(),
						);
					}
					//who has the book, and are they the owner
					$book_owner = $val->getOwner()->getUsername();
				}
				elseif($key == 'current' && $val)
				{
					$repository = $this->getDoctrine()->getRepository('TFLLibraryUserBundle:User');
					$book_array[$book_id]['current_borrower'] = $repository->findOneById($val);
				}
				elseif($key == 'current')
				{
					$book_array[$book_id]['current_borrower'] = FALSE;
				}
			}
		}
		
		return array('books' => $book_array);
	}
}
