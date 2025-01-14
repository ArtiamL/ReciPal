<?php

namespace config\dao;

use PDO;

class UserDAO implements DAO
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getUserByEmail($email): array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($user)
    {
        $stmt  = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(":name", $user->getName());
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":password", $user->getPassword());
        $stmt->execute();
    }

    function findById($id): array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findByUUId($uuid): array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE uuid = :uuid");
        $stmt->bindParam(":uuid", $uuid);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    function getAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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