<?php

namespace lib\dao;

use lib\entities\Role;
use lib\entities\User;

final class UserDAO extends DAO
{

    public function __construct(\PDO $db)
    {
        parent::__construct($db, "users");
    }

    public function getUserByEmail($email): ?User
    {
        $stmt = $this->db->prepare("SELECT u.user_uuid, u.email, u.username, u.password_hash, u.active, GROUP_CONCAT(r.role_name SEPARATOR ', ') AS roles
            FROM {$this->table} u
            LEFT JOIN user_role ur on u.user_id = ur.user_id
            LEFT JOIN roles r on ur.role_id = r.role_id
            WHERE u.email = :email
            GROUP BY u.user_id;");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $data = $stmt->fetch();

        if (!$data) return null;

        error_log(print_r($data, true));

        $roles = [];

        foreach ($data as $col) {
            error_log($col);
            if (!isset($roles[$data["roles"]])) {
                $roles[$data["roles"]] = new Role($data["roles"]);
            }
        }

        return new User($data, $roles);
    }

    public function create($user)
    {
        $stmt  = $this->db->prepare("INSERT INTO {$this->table} (email, username, password_hash, active) VALUES (:email, :username, :password_hash, :active)");
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":name", $user->getName());
        $stmt->bindParam(":password", $user->getPassword());
        $stmt->bindParam(":active", $user->getActive());
        $stmt->execute();
        return $this->getUUIDFromID($this->db->lastInsertId());
    }

    // TODO: refactor for API.
    public function getUUIDFromID($id): string
    {
        $stmt = $this->db->prepare("SELECT user_uuid FROM {$this->table} WHERE user_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function findByUUId($uuid): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE uuid = :uuid");
        $stmt->bindParam(":uuid", $uuid);
        $stmt->execute();
        return $stmt->fetch();
    }

    function update($user)
    {
        $stmt  = $this->db->prepare("UPDATE {$this->table} SET name = :name, email = :email, password = :password WHERE id = :id");
        $stmt->bindParam(":id", $user->getId());
        $stmt->bindParam(":name", $user->getName());
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":password", $user->getPassword());
        $stmt->execute();
    }

    function delete($obj)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $obj->getId());
        $stmt->execute();
    }
}

?>