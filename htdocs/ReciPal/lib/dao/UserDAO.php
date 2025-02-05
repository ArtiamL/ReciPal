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

    public function getUserByEmail($email): array|bool {
        $stmt = $this->db->prepare("SELECT u.user_uuid, u.email, u.username, u.password_hash, u.active, GROUP_CONCAT(r.role_name SEPARATOR ', ') AS roles
            FROM {$this->table} u
            LEFT JOIN user_role ur on u.user_id = ur.user_id
            LEFT JOIN roles r on ur.role_id = r.role_id
            WHERE u.email = :email
            GROUP BY u.user_id;");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $row = $stmt->fetch();

        if (!$row)
            return false;

        $row['roles'] = $row['roles'] ? array_map('trim', explode(',', $row['roles'])) : [];

        return $row;
    }

    public function exists(string $username, string $email): bool {
        if (!isset($username, $email))
            return false;

        $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE username = :username OR email = :email");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    public function create($user): bool {
        try {
            $uuid = $user->getUuid();
            $email = $user->getEmail();
            $uname = $user->getUsername();
            $password = $user->getPassword();

            // Use transaction for full rollback on fail with insertion into multiple tables.
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("INSERT INTO {$this->table}(user_uuid, email, username, password_hash) VALUES (:uuid, :email, :username, :password)");
            $stmt->bindParam(":uuid", $uuid);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":username", $uname);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
            $lastInsertId = $this->db->lastInsertId();

            $stmt = $this->db->prepare("SELECT role_id FROM roles WHERE role_name = 'enduser'");
            $stmt->execute();
            $roleID = $stmt->fetchColumn();

            $stmt = $this->db->prepare("INSERT INTO user_role (user_id, role_id) VALUES (:user_id, :role_id)");
            $stmt->bindParam(":user_id", $lastInsertId);
            $stmt->bindParam(":role_id", $roleID);
            $stmt->execute();

            $this->db->commit();

            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            return false;
        }
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

    function delete($user) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE user_uuid = :id");
        $stmt->bindParam(":id", $user->getUUID());

        return $stmt->execute();
    }
}