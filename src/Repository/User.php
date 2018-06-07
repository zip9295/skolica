<?php
namespace Repository;
use \Mapper\MapperInterface;

class User implements RepositoryInterface
{
    private $mapper;

    /**
     * User constructor.
     * @param $mapper
     */
    public function __construct(MapperInterface $mapper, UserService $userService)
    {
        $this->mapper = $mapper;
    }

    public function create($data)
    {
        $data['pasword'] = $this->UserService->hashPassword($data['password']);
        $this->mapper->create($data);
    }

    public function getList($params)
    {
        // TODO: Implement getList() method.
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function update($data)
    {
        // TODO: Implement update() method.
    }

    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }


}