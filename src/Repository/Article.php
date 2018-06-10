<?php
namespace Repository;
use Mapper\MapperInterface;
class Article implements RepositoryInterface
{
    /**
     * @var MapperInterface
     */
    private $mapper;

    /**
     * User constructor.
     * @param $mapper
     */
    public function __construct(MapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param $data
     */
    public function create($data)
    {
        $this->mapper->create($data);
    }

    /**
     * @param $params
     */
    public function getList($params)
    {
        $this->mapper->fetchList($params);
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