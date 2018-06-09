<?php
namespace Mapper;
class Category implements MapperInterface
{
    /**
     * @var \PDO
     */
    private $driver;

    /**
     * User constructor.
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
        $sql = "INSERT INTO `category`(categoryId, categoryName, title, description, body, parentCategory, username, 
                                       createdAt, updatedAt)
                VALUES (NULL , {$data['categoryName']}, {$data['title']}, {$data['body']}, {$data['parentCategory']}
                        {$data['username']}, {$data['createdAt']},{$data['updatedAt']})";
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
        $sql = "SELECT * FROM `category`";
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
        $sql = "SELECT * FROM `category` WHERE `categoryId`= $id";
        $statement = $this->driver->query($sql);
        if (!$statement){
            var_dump($this->driver->errorInfo()[2]);
            die();
            throw new \Exception($this->driver->errorInfo()[2]);
        }
        $category = $statement->fetch();
        if (!$category) {
            throw new \Exception('Kategorija nije pronadjena u bazi');
        }
        return $category;
    }

    /**
     * @param $data
     * @return integer
     * @throws \Exception
     */
    public function update($data)
    {
        $sql = "UPDATE `category` SET 
        `categoryName` = '{$data['categoryName']}',
        `title`= '{$data['title']}',
        `description`= '{$data['description']}',
        `body`= '{$data['body']}',
        `parentCategory`= '{$data['parentCategory']}',
        `username`= '{$data['username']}',
        `updatedAt`= '{$data['updatedAt']}'
        WHERE `categoryId`='{$data['categoryId']}'";
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
        $sql = "DELETE * FROM `user` WHERE `userId`= $id";
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
