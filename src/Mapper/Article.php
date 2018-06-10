<?php
namespace Mapper;
class Article implements MapperInterface
{

    /**
     * @var \PDO
     */
    private $driver;
    /**
     * Article constructor.
     * @param $pdo
     */
    public function __construct($pdo)
    {
        $this->driver = $pdo;
    }

    /**
     * @param $data
     * @return integer
     * @throws \Exception
     */
    public function create($data)
    {
        $sql = "INSERT INTO `article`(articleId, title, description, body, category, username)
                VALUES (NULL , {$data['title']}, {$data['description']}, {$data['body']},{$data['category']}, {$data['username']}";
        if (!$this->driver->exec($sql)) {
            var_dump($this->driver->errorInfo()[2]);
            die();
            throw new \Exception($this->driver->errorInfo()[2]);
        }
        return $this->driver->lastInsertId();
    }

    /**
     * @param $params
     * @throws \Exception
     */
    public function fetchList($params)
    {
        $sql = "SELECT * FROM `article`";
        $statement = $this->driver->query($sql);
        if (!$statement){
            var_dump($this->driver->errorInfo()[2]);
            die();
            throw new \Exception($this->driver->errorInfo()[2]);
        }
        $statement->fetchAll();
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function fetchById($id)
    {
        $sql = "SELECT * FROM `article` WHERE `articleId`= $id";
        $statement = $this->driver->query($sql);
        if (!$statement){
            var_dump($this->driver->errorInfo()[2]);
            die();
            throw new \Exception($this->driver->errorInfo()[2]);
        }
        $article = $statement->fetch();
        if (!$article) {
            throw new \Exception('Artikal nije pronadjen u bazi');
        }
        return $article;
    }

    /**
     * @param $data
     * @return integer
     * @throws \Exception
     */
    public function update($data)
    {
        $sql = "UPDATE `article` SET 
        `title` = '{$data['title']}',
        `description`= '{$data['description']}',
        `body` = '{$data['body']}',
        `category` = '{$data['category']}',
        `username` = '{$data['username']}'
        WHERE `articleId`='{$data['articleId']}'";
        if (!$this->driver->exec($sql)) {
            var_dump($this->driver->errorInfo()[2]);
            die();
            throw new \Exception($this->driver->errorInfo()[2]);
        }
        return $this->driver->lastInsertId();
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function deleteById($id)
    {
        $sql = "DELETE * FROM `article` WHERE `articleId`= $id";
        $statement = $this->driver->exec($sql);
        if (!$statement){
            var_dump($this->driver->errorInfo()[2]);
            die();
            throw new \Exception($this->driver->errorInfo()[2]);
        }
        if (!$this->driver->exec($sql)) {
            var_dump($this->driver->errorInfo()[2]);
            die();
            throw new \Exception($this->driver->errorInfo()[2]);
        }
    }

}