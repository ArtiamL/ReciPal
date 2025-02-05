<?php

namespace lib\entities;

class User {
    private $UUID;
    private $username;
    private $email;
    private $passwordHash;
    private $isActive;
    private $roles = [];

    public function __construct(array $data) {
        $this->UUID = $data['user_uuid'] ?? null;
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->passwordHash = $data['password_hash'] ?? null;
        $this->isActive = $data['active'] ?? true;
        $this->roles = $data['roles'] ?? [];
    }

    public function getUUID() {
        return $this->UUID;
    }

    public function setUUID($UUID) {
        $this->UUID = $UUID;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->passwordHash;
    }

    public function setPassword($passwordHash) {
        $this->passwordHash = $passwordHash;
    }

    public function isActive() {
        return $this->isActive;
    }

    public function hasRole(string $role): bool {
        return in_array($role, $this->roles);
    }

    public function getRoles(): array {
        return $this->roles;
    }

    public function getRolesAsStringArr(): array {
        $strRoles = [];

        foreach ($this->roles as $role) {
//            strRoles[] = $role.__toString();
        }
    }

    public function getUsername() {
        return $this->username;
    }
}