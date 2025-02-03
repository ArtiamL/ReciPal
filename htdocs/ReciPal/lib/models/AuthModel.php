<?php

namespace lib\models;

use lib\dao\RoleDAO;
use lib\dao\UserDAO;
use lib\entities\Permission;
use lib\entities\Role;
use lib\entities\User;

final class AuthModel {
    private $userDAO;
    private $roleDAO;

    public function __construct(UserDAO $userDAO, RoleDAO $roleDAO) {
        $this->userDAO = $userDAO;
        $this->roleDAO = $roleDAO;
    }

    public function login(string $email, string $password): ?User {
        $userData = $this->userDAO->getUserByEmail($email);
        if (!$userData) return null;

        $user = $this->createUserObj($userData);

        return $this->authenticate($user, $password) ? $user : null;
    }

    private function authenticate(User $user, string $password): bool {
        if (password_verify($password, $user->getPassword())) {
            return true;
        }
        return false;
    }

    public function register(array $user): string {
        $exists = $this->userDAO->getUserByEmail($_POST['email']);
        echo var_export($exists, true);

        if ($exists) {
            // TODO: Refactor into SessionController for better separation of concern.
            http_response_code(409);
            return json_encode(['message' => 'User already exists.', 'code' => 409]);
        }

        $userObj = new User($user, [new Role('enduser', $this->roleDAO->getPermissionsForRole('enduser'))]);

        $userObj->setPassword(password_hash($user['password'], PASSWORD_DEFAULT));
        $userObj->setUUID($this->generateUUIDv7());

        return $this->userDAO->create($userObj) ? json_encode(['message' => 'Successfully Registered User', 'code' => 201]) : json_encode(['message' => 'Failed to register user.', 'code' => 500]);
    }

    public function deleteUser(string $user): bool {
        $userData = $this->userDAO->getUserByEmail($user);
        if (!$userData) return false;

        $user = $this->createUserObj($userData);

        return $this->userDAO->delete($user);
    }

    # Author: Zhiyanov, A.
    # Article: UUIDv7 in 33 languages.
    # Source: https://antonz.org/uuidv7/#php
    # Accessed: 2 Feb. 2025
    private function generateUUIDv7(): string {
            // random bytes
            $value = random_bytes(16);

            // current timestamp in ms
            $timestamp = intval(microtime(true) * 1000);

            // timestamp
            $value[0] = chr(($timestamp >> 40) & 0xFF);
            $value[1] = chr(($timestamp >> 32) & 0xFF);
            $value[2] = chr(($timestamp >> 24) & 0xFF);
            $value[3] = chr(($timestamp >> 16) & 0xFF);
            $value[4] = chr(($timestamp >> 8) & 0xFF);
            $value[5] = chr($timestamp & 0xFF);

            // version and variant
            $value[6] = chr((ord($value[6]) & 0x0F) | 0x70);
            $value[8] = chr((ord($value[8]) & 0x3F) | 0x80);

            return bin2hex($value);
    }

    private function createUserObj(array $userData): ?User {
        $roles = [];

        foreach ($userData['roles'] as $row) {
            $permissions = array_map(fn($permission) => new Permission($permission['permission_name']), $this->roleDAO->getPermissionsForRole($row));
            $roles[$row] = new Role($row, $permissions);
        }

        return new User($userData, $roles);
    }
}