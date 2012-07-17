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
	 * @ORM\Column(type="integer")
	 */
	protected $book_id;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $user_id;
	
	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $is_deleted = FALSE;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $created_at;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $updated_at;

 

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
	 * Set book_id
	 *
	 * @param integer $bookId
	 * @return BookOwner
	 */
	public function setBookId($bookId)
	{
		$this->book_id = $bookId;
		return $this;
	}

	/**
	 * Get book_id
	 *
	 * @return integer 
	 */
	public function getBookId()
	{
		return $this->book_id;
	}

	/**
	 * Set user_id
	 *
	 * @param integer $userId
	 * @return BookOwner
	 */
	public function setUserId($userId)
	{
		$this->user_id = $userId;
		return $this;
	}

	/**
	 * Get user_id
	 *
	 * @return integer 
	 */
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * Set is_deleted
	 *
	 * @param boolean $isDeleted
	 * @return BookOwner
	 */
	public function setIsDeleted($isDeleted)
	{
		$this->is_deleted = $isDeleted;
		return $this;
	}

	/**
	 * Get is_deleted
	 *
	 * @return boolean 
	 */
	public function getIsDeleted()
	{
		return $this->is_deleted;
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
	
}