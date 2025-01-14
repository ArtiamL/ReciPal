<?php

namespace config\dao;

use config\dao\DAO;

class RoleDAO implements DAO
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    function create($role_name)
    {
        $stmt = $this->db->prepare("INSERT INTO roles (role_name) VALUES(:role_name)");
        $stmt->bindParam(":role_name", $role_name);
        $stmt->execute();
    }

    function findById($id)
    {
        // TODO: Implement findById() method.
    }

    function getAll()
    {
        // TODO: Implement getAll() method.
    }

    function update($obj)
    {
        // TODO: Implement update() method.
    }

    function delete($obj)
    {
        // TODO: Implement delete() method.
    }
}