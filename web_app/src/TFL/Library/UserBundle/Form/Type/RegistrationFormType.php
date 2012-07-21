<?php
namespace TFL\Library\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends BaseType
{
    
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		parent::buildForm($builder, $options);
	
		// add custom form field
		$builder->add('firstName');
		$builder->add('betaCode');
	}

	public function getFirstName()
	{
		return 'tfl_library_user_registration';
	}
}
