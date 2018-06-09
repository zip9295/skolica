<?php
namespace Model;
class Category
{
    private $categoryId;
    private $categoryName;
    private $title;
    private $description;
    private $body;
    private $parentCategory;
    private $username;
    private $createdAt;
    private $updatedAt;

    public function __construct($categoryId, $categoryName, $title, $description, $body, $parentCategory, $username,
                                $createdAt, $updatedAt)
    {
        $this->categoryId = $categoryId;
        $this->categoryName = $categoryName;
        $this->title = $title;
        $this->description = $description;
        $this->body = $body;
        $this->parentCategory = $parentCategory;
        $this->username = $username;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->categoryName;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getParentCategory()
    {
        return $this->parentCategory;
    }
    public function getUsername()
    {
        return $this->username;
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