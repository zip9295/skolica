<?php
namespace Mapper;
class User implements MapperInterface
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
        $sql = "INSERT INTO `user`(userId, firstName, lastName, email, password, username, age, status)
                VALUES (NULL , {$data['firstName']}, {$data['lastName']}, {$data['email']}
                {$data['password']}, {$data['username']},{$data['age']},{$data['status']})";
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
     * @return array
     */
    public function fetchList($params)
    {
        $sql = "SELECT * FROM `user` LIMIT 100";
        $statement = $this->driver->query($sql);
        if (!$statement){
            var_dump($this->driver->errorInfo()[2]);
            die();
            throw new \Exception($this->driver->errorInfo()[2]);
        }
        return $statement->fetchAll();
    }

    /**
     * @param $id
     * @throws \Exception
     * @return array
     */
    public function fetchById($id)
    {
        $sql = "SELECT * FROM `user` WHERE `userId`= $id";
        $statement = $this->driver->query($sql);
        if (!$statement){
            var_dump($this->driver->errorInfo()[2]);
            die();
            throw new \Exception($this->driver->errorInfo()[2]);
        }
        $user = $statement->fetch();
        if (!$user) {
            throw new \Exception('Korisnik nije pronadjen u bazi');
        }
        return $user;

    }

    /**
     * @param $data
     * @return integer
     * @throws \Exception
     */
    public function update($data)
    {
        $sql = "UPDATE `user` SET 
        `email` = '{$data['email']}',
        `password`= '{$data['email']}',
        `firstName`= '{$data['firstName']}',
        `lastName`= '{$data['lastName']}',
        `username`= '{$data['username']}',
        `status`= '{$data['status']}',
        `age`= '{$data['age']}'
        WHERE `userId`='{$data['userId']}'";
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
     * @return boolean
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