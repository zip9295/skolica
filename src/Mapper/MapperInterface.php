<?php
namespace Mapper;
Interface MapperInterface
{
    public function create($data);
    public function fetchList($params);
    public function fetchById($id);
    public function update($data);
    public function deleteById($id);
}