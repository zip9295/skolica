<?php
namespace Model;
class User
{
    private $userId;
    private $name;
    private $email;
    private $password;
    private $image;
    private $status;
    private $createdAt;
    private $updatedAt;

    /**
     * User constructor.
     * @param int $userId
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $image
     * @param boolean $status
     * @param string $createdAt
     * @param string $updatedAt
     */
    public function __construct($userId, $name, $email, $password, $image, $status, $createdAt, $updatedAt)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}