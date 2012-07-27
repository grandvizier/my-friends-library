<?php 
namespace TFL\Library\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TFL\Library\UserBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="borrow_item")
 */
class Borrow
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * The type of item borrowed (for when you can borrow more than just books)
	 * 
	 * @ORM\Column(name="item_type", type="integer")
	 */
	protected $itemType = 1;
	
	/**
	 * @ORM\Column(name="item_id", type="integer")
	 */
	protected $itemId;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $borrowed_date;
	
	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $returned = FALSE;

	/**
	 * @ORM\Column(type="datetime", nullable=TRUE)
	 */
	protected $returned_date;
	
	/**
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="borrowed_by", referencedColumnName="id")
	 */
	private $borrowedBy;

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
	 * Set itemType
	 *
	 * @param integer $itemType
	 * @return Borrow
	 */
	public function setItemType($itemType)
	{
		$this->itemType = $itemType;
		return $this;
	}

	/**
	 * Get itemType
	 *
	 * @return integer 
	 */
	public function getItemType()
	{
		return $this->itemType;
	}

	/**
	 * Set itemId
	 *
	 * @param integer $itemId
	 * @return Borrow
	 */
	public function setItemId($itemId)
	{
		$this->itemId = $itemId;
		return $this;
	}

	/**
	 * Get itemId
	 *
	 * @return integer 
	 */
	public function getItemId()
	{
		return $this->itemId;
	}

	/**
	 * Set borrowed_date
	 *
	 * @param datetime $borrowedDate
	 * @return Borrow
	 */
	public function setBorrowedDate($borrowedDate)
	{
		$this->borrowed_date = $borrowedDate;
		return $this;
	}

	/**
	 * Get borrowed_date
	 *
	 * @return datetime 
	 */
	public function getBorrowedDate()
	{
		return $this->borrowed_date;
	}

	/**
	 * Set returned
	 *
	 * @param boolean $returned
	 * @return Borrow
	 */
	public function setReturned($returned)
	{
		$this->returned = $returned;
		return $this;
	}

	/**
	 * Get returned
	 *
	 * @return boolean 
	 */
	public function getReturned()
	{
		return $this->returned;
	}

	/**
	 * Set returned_date
	 *
	 * @param datetime $returnedDate
	 * @return Borrow
	 */
	public function setReturnedDate($returnedDate)
	{
		$this->returned_date = $returnedDate;
		return $this;
	}

	/**
	 * Get returned_date
	 *
	 * @return datetime 
	 */
	public function getReturnedDate()
	{
		return $this->returned_date;
	}

	/**
	 * Set borrowedBy
	 *
	 * @param User $borrowedBy
	 * @return Borrow
	 */
	public function setBorrowedBy(User $borrowedBy = null)
	{
		$this->borrowedBy = $borrowedBy;
		return $this;
	}

	/**
	 * Get borrowedBy
	 *
	 * @return User 
	 */
	public function getBorrowedBy()
	{
		return $this->borrowedBy;
	}
}