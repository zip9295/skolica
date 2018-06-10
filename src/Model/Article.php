<?php
namespace Model;
class Article
{
    private $articleId;
    private $title;
    private $description;
    private $body;
    private $category;
    private $username;
    private $createdAt;
    private $updatedAt;

    /**
     * Article constructor.
     * @param $articleId
     * @param $title
     * @param $description
     * @param $body
     * @param $category
     * @param $username
     * @param $createdAt
     * @param $updatedAt
     */
    public function __construct($articleId, $title, $description, $body, $category, $username, $createdAt, $updatedAt)
    {
        $this->articleId = $articleId;
        $this->title = $title;
        $this->description = $description;
        $this->body = $body;
        $this->category = $category;
        $this->username = $username;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return integer
     */
    public function getArticleId()
    {
        return $this->articleId;
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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return string
     */
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