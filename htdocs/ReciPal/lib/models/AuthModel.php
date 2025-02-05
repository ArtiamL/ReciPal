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

    public function login(string $email, string $password): array|int {
        $userData = $this->userDAO->getUserByEmail($email);
        if (!$userData) return 404;

        $userData['roles'] = array_flip($userData['roles']);

        foreach ($userData['roles'] as $role => &$permission) {
            $permission = $this->roleDAO->getPermissionsForRole($role);
        }

        error_log(var_export($userData, true));

//        $user = new User($userData);

//        error_log("AuthModel->login, 32: " . var_export($user, true));

        if ($this->authenticate($userData['password_hash'], $password)) {
            $userData['code'] = 200;
            return $userData;
        }

        return 400;

//        return $this->authenticate($userData['password_hash'], $password) ? $userData : 400;
    }

    private function authenticate(string $userPass, string $password): bool {
        if (password_verify($password, $userPass)) {
            return true;
        }
        return false;
    }

    /**
     * @param array $user
     * @return int 201 - Successfully registered.
     *             500 - Failed to register.
     *             409 - User already exists.
     */
    public function register(array $user): int {
//        $exists = $this->userDAO->getUserByEmail($_POST['email']);

        if ($this->userDAO->exists($user['username'], $user['email']))
            return 409; // TODO: decide whether to return status codes or bool

        $userObj = new User($user); // TODO: decide whether to refactor this to remove need for obj, as it is not currently being passed due to recent changes.

        $userObj->setPassword(password_hash($user['password'], PASSWORD_DEFAULT));
        $userObj->setUUID($this->generateUUIDv7());

        return $this->userDAO->create($userObj) ? 201: 500;
    }

    public function deleteUser(string $user): bool {
        $userData = $this->userDAO->getUserByEmail($user);
        if (!$userData) return false;

        $user = $this->createUserObj($userData);

        return $this->userDAO->delete($user);
    }

    public function deactivateUser(string $userUUID): bool {
        if (!$this->userDAO->findByUUId($userUUID))
            return 404; // TODO: decide whether to return status codes or bool

        if ($this->userDAO->deactivate($userUUID))
            return 204;
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

    // TODO: delete? no longer necessary?
    private function createUserObj(array $userData): ?User {
        $roles = [];

        foreach ($userData['roles'] as $row) {
            $permissions = array_map(fn($permission) => new Permission($permission['permission_name']), $this->roleDAO->getPermissionsForRole($row));
            $roles[$row] = new Role($row, $permissions);
        }

        return new User($userData, $roles);
    }
}