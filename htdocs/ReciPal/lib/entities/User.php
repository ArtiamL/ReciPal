<?php

namespace lib\entities;

class User {
    private $UUID;
    private $username;
    private $email;
    private $passwordHash;
    private $isActive;
    private $roles = [];

    public function __construct(array $data, array $roles = []) {
        $this->UUID = $data['user_uuid'];
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->passwordHash = $data['password_hash'];
        $this->isActive = $data['active'];
        $this->roles = array_values($roles);
    }

    public function getUUID() {
        return $this->UUID;
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

    public function getUsername() {
        return $this->username;
    }
}