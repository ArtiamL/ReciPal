<?php

namespace lib\dao;

class RoleDAO extends DAO
{

    public function __construct(\PDO $db)
    {
        parent::__construct($db, "roles");
    }

    public function create($role_name)
    {
        $stmt = $this->db->prepare("INSERT INTO roles (role_name) VALUES(:role_name)");
        $stmt->bindParam(":role_name", $role_name);
        $stmt->execute();
        return $this->db->lastInsertId();
    }
    function update($obj)
    {
        $stmt = $this->db->prepare("UPDATE roles SET role_name = :role_name WHERE role_id = :id");
        $stmt->bindParam(":role_name", $obj->getRoleName());
        $stmt->bindParam(":id", $obj->getId());
        $stmt->execute();
    }

    function delete($obj)
    {
        $stmt = $this->db->prepare("DELETE FROM roles WHERE role_id = :id");
        $stmt->bindParam(":id", $obj->getId());
        $stmt->execute();
    }
}