<?php

namespace lib\dao;

class PermissionDAO extends DAO
{
    public function __construct($db)
    {
        parent::__construct($db, "permissions");
    }

    function create($permission)
    {
        $stmt = $this->db->prepare("INSERT INTO permissions (permission_name) VALUES(:permission)");
        $stmt->bindParam(':permission', $permission);
        $stmt->execute();
        return $this->db->lastInsertId();
    }
    function update($obj)
    {
        $stmt = $this->db->prepare("UPDATE permissions SET permission_name = :permission WHERE permission_id = :id");
        $stmt->bindParam(':permission', $obj->permission);
        $stmt->bindParam(':id', $obj->id);
        $stmt->execute();
    }

    function delete($obj)
    {
        $stmt = $this->db->prepare("DELETE FROM permissions WHERE permission_id = :id");
        $stmt->bindParam(':id', $obj->id);
        $stmt->execute();
    }
}