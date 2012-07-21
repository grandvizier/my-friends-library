<?php
namespace TFL\Library\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * 
	 * @var @Assert\NotBlank(message="Registration requiers this secrect password.", groups={"Registration"})
	 */
	protected $betaCode;
	
	/**
	 * @ORM\Column(name="first_name", type="string", length=255)
	 *
	 * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
	 * @Assert\MinLength(limit="2", message="The name is too short.", groups={"Registration", "Profile"})
	 * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
	 */
	protected $firstName;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Get firstName
	 *
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}
	
	/**
	 * Set firstName
	 *
	 * @param string $firstName
	 * @return User
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
		return $this;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getBetaCode()
	{
		return $this->betaCode;
	}
	
	/**
	 * 
	 * @return User
	 */
	public function setBetaCode($betaCode)
	{
		$this->betaCode = $betaCode;
		return $this;
	}
	
	public function isValidBetaCode()
	{
		return $this->betaCode == 's';
	}
}