<?php
namespace Repository;
use \Mapper\MapperInterface;
use \Service\UserService;

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

    /**
     * @param $data
     */
    public function create($data)
    {
        $data['pasword'] = $this->UserService->hashPassword($data['password']);
        $this->mapper->create($data);
    }

    /**
     * @param $params
     */
    public function getList($params = [])
    {
        return $this->mapper->fetchList($params);
    }

    /**
     * @param $id
     */
    public function getById($id)
    {
        $this->mapper->fetchById($id);
    }

    /**
     * @param $data
     */
    public function update($data)
    {
        $this->mapper->update($data);
    }

    /**
     * @param $id
     */
    public function deleteById($id)
    {
        $this->mapper->deleteById($id);
    }


}