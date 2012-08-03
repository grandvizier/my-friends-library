<?php 
namespace TFL\Library\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TFL\Library\UserBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="borrow_user_book")
 */
class BorrowBook
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @ORM\ManyToOne(targetEntity="TFL\Library\BookBundle\Entity\UserBook", inversedBy="borrowings")
	 * @ORM\JoinColumn(name="user_book_id", referencedColumnName="id")
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
	 * Set itemId
	 *
	 * @param UserBook $itemId
	 * @return Borrow
	 */
	public function setItemId(UserBook $itemId)
	{
		$this->itemId = $itemId;
		return $this;
	}

	/**
	 * Get itemId
	 *
	 * @return UserBook 
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