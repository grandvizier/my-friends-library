<?php 
namespace TFL\Library\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegistrationController extends BaseController
{
	public function registerAction()
	{
		$route_to_homepage = $this->container->get('router')->generate('_homepage');
		if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY'))
		{
			// redirect authenticated users to homepage
			return new RedirectResponse($route_to_homepage);
		}
		
		$form = $this->container->get('fos_user.registration.form');
		$formHandler = $this->container->get('fos_user.registration.form.handler');
		$confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

		$process = $formHandler->process($confirmationEnabled);
		if ($process) {
			$user = $form->getData();

			$this->container->get('logger')->info(
					sprintf('New user registration: %s', $user)
			);

			$this->authenticateUser($user);

			$this->setFlash('fos_user_success', 'registration.flash.user_created');

			return new RedirectResponse($route_to_homepage);
		}

		return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
				'form' => $form->createView(),
		));
	}
}