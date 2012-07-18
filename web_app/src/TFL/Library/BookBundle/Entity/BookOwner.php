<?php 
namespace TFL\Library\BookBundle\Entity;

use Symfony\Component\Security\Acl\Exception\Exception;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="book_owner")
 */
class BookOwner
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;	
	
	/**
	 * @ORM\Column(name="book_id", type="integer")
	 */
	protected $bookId;
	
	/**
	 * @ORM\Column(name="user_id", type="integer")
	 */
	protected $userId;
	
	/**
	 * @ORM\Column(name="is_deleted", type="boolean")
	 */
	protected $isDeleted = FALSE;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $created_at;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $updated_at;

	/**
	 * @ORM\ManyToOne(targetEntity="Book")
	 * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
	 */
	private $book;
	
	/**
	 * @ORM\ManyToOne(targetEntity="TFL\Library\UserBundle\Entity\User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private $owner;
	

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
	 * Set bookId
	 *
	 * @param integer $bookId
	 * @return BookOwner
	 */
	public function setBookId($bookId)
	{
		$this->bookId = $bookId;
		return $this;
	}

	/**
	 * Get bookId
	 *
	 * @return integer 
	 */
	public function getBookId()
	{
		return $this->bookId;
	}

	/**
	 * Set userId
	 *
	 * @param integer $userId
	 * @return BookOwner
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
		return $this;
	}

	/**
	 * Get userId
	 *
	 * @return integer 
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * Set isDeleted
	 *
	 * @param boolean $isDeleted
	 * @return BookOwner
	 */
	public function setIsDeleted($isDeleted)
	{
		$this->isDeleted = $isDeleted;
		return $this;
	}

	/**
	 * Get isDeleted
	 *
	 * @return boolean 
	 */
	public function getIsDeleted()
	{
		return $this->isDeleted;
	}

	/**
	 * Set created_at
	 *
	 * @param datetime $createdAt
	 * @return BookOwner
	 */
	public function setCreatedAt($createdAt)
	{
		$this->created_at = $createdAt;
		return $this;
	}

	/**
	 * Get created_at
	 *
	 * @return datetime 
	 */
	public function getCreatedAt()
	{
		return $this->created_at;
	}

	/**
	 * Set updated_at
	 *
	 * @param datetime $updatedAt
	 * @return BookOwner
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updated_at = $updatedAt;
		return $this;
	}

	/**
	 * Get updated_at
	 *
	 * @return datetime 
	 */
	public function getUpdatedAt()
	{
		return $this->updated_at;
	}
	
	/**
	 * @ORM\PrePersist()
	 * @ORM\PreUpdate()
	 */
	public function preUpdate()
	{
		
		$this->setUpdatedAt(new \DateTime("now"));
	}
	
	/**
	 * 
	 * @return Book 
	 */
	public function getBook()
	{
		return $this->book;
	}
	
	/**
	 * 
	 * @param Book $book
	 * @return BookOwner 
	 */
	public function setBook($book)
	{
		$this->book = $book;
		return $this;
	}
	
	/**
	 * 
	 * @return User 
	 */
	public function getOwner()
	{
		return $this->owner;
	}
	
	/**
	 * 
	 * @param User $owner
	 * @return BookOwner 
	 */
	public function setOwner($owner)
	{
		$this->owner = $owner;
		return $this;
	}
	
}