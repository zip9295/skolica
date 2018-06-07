<?php
namespace Repository;
interface RepositoryInterface
{
    public function create($data);
    public function getList($params);
    public function getById($id);
    public function update($data);
    public function deleteById($id);
}