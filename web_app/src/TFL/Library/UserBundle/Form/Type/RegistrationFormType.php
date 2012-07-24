<?php
namespace TFL\Library\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends BaseType
{
    
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		parent::buildForm($builder, $options);
	
		// custom form fields
		$builder->add('betaCode');
		$builder->add('firstName');
		$builder->add('lastName');
		$builder->add('address');
		$builder->add('address2');
		$builder->add('city');
		$builder->add('phone');
	}

	public function getFirstName()
	{
		return 'tfl_library_user_registration';
	}
}
