<?php

namespace lib\dao;

final class UserDAO extends DAO
{

    public function __construct(\PDO $db)
    {
        parent::__construct($db, "users");
    }

    public function getUserByEmail($email): array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($user)
    {
        $stmt  = $this->db->prepare("INSERT INTO users (email, username, password_hash, active) VALUES (:email, :username, :password_hash, :active)");
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
        $stmt = $this->db->prepare("SELECT user_uuid FROM users WHERE user_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function findByUUId($uuid): array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE uuid = :uuid");
        $stmt->bindParam(":uuid", $uuid);
        $stmt->execute();
        return $stmt->fetch();
    }

    function update($user)
    {
        $stmt  = $this->db->prepare("UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id");
        $stmt->bindParam(":id", $user->getId());
        $stmt->bindParam(":name", $user->getName());
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":password", $user->getPassword());
        $stmt->execute();
    }

    function delete($obj)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(":id", $obj->getId());
        $stmt->execute();
    }
}

?>