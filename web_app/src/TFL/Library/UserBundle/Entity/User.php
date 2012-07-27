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
	 * Beta Code is a key users need to enter on registration to limit how many user's this app can handle
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

	/**
	 * @ORM\Column(name="last_name", type="string", length=255)
	 *
	 * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
	 * @Assert\MaxLength(limit="255", message="Last name is too long.", groups={"Registration", "Profile"})
	 */
	protected $lastName;

	/**
	 * @ORM\Column(name="address", type="string", length=255)
	 *
	 * @Assert\NotBlank(message="Please enter your address.", groups={"Registration", "Profile"})
	 * @Assert\MaxLength(limit="255", message="Address is too long.", groups={"Registration", "Profile"})
	 */
	protected $address;

	/**
	 * @ORM\Column(name="address2", type="string", length=255, nullable=TRUE)
	 *
	 * @Assert\MaxLength(limit="255", message="Additional address field is too long.", groups={"Registration", "Profile"})
	 */
	protected $address2;

	/**
	 * @ORM\Column(name="city", type="string", length=255, nullable=TRUE)
	 *
	 * @Assert\MaxLength(limit="255", message="City field is too long.", groups={"Registration", "Profile"})
	 */
	protected $city;

	/**
	 * @ORM\Column(name="phone", type="string", length=20)
	 *
	 * @Assert\NotBlank(message="Please enter your phone number.", groups={"Registration", "Profile"})
	 * @Assert\MinLength(limit="5", message="Phone number is too short.", groups={"Registration", "Profile"})
	 * @Assert\MaxLength(limit="20", message="Phone field is too long.", groups={"Registration", "Profile"})
	 */
	protected $phone;
	
	
	
	
	public function __construct()
	{
		parent::__construct();
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
	
	
	

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
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
	 * Get firstName
	 *
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}
	
	/**
	 * Set lastName
	 *
	 * @param string $lastName
	 * @return User
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
		return $this;
	}
	
	/**
	 * Set address
	 *
	 * @param string $address
	 * @return User
	 */
	public function setAddress($address)
	{
		$this->address = $address;
		return $this;
	}

	/**
	 * Get address
	 *
	 * @return string 
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * Set address2
	 *
	 * @param string $address2
	 * @return User
	 */
	public function setAddress2($address2)
	{
		$this->address2 = $address2;
		return $this;
	}

	/**
	 * Get address2
	 *
	 * @return string 
	 */
	public function getAddress2()
	{
		return $this->address2;
	}

	/**
	 * Set city
	 *
	 * @param string $city
	 * @return User
	 */
	public function setCity($city)
	{
		$this->city = $city;
		return $this;
	}

	/**
	 * Get city
	 *
	 * @return string 
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * Set phone
	 *
	 * @param string $phone
	 * @return User
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;
		return $this;
	}

	/**
	 * Get phone
	 *
	 * @return string 
	 */
	public function getPhone()
	{
		return $this->phone;
	}

}