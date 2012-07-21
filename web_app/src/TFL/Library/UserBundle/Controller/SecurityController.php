<?php
namespace TFL\Library\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends BaseController
{
	public function loginAction()
	{
		if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY'))
		{
			// redirect authenticated users to homepage
			return new RedirectResponse($this->container->get('router')->generate('_homepage'));
		}

		$request = $this->container->get('request');
		$session = $request->getSession();
		
		// get the error if any (works with forward and redirect -- see below)
		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
		} else {
			$error = '';
		}
	
		if ($error) {
			// TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
			$error = $error->getMessage();
		}
		// last username entered by the user
		$lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);
	
		$csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');
	
		return $this->container->get('templating')->renderResponse('FOSUserBundle:Security:login.html.'.$this->container->getParameter('fos_user.template.engine'), array(
				'last_username' => $lastUsername,
				'error'         => $error,
				'csrf_token' => $csrfToken,
		));
	}
}