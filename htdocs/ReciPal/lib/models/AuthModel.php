<?php

namespace lib\models;

use lib\dao\UserDAO;
use lib\entities\User;

final class AuthModel {
    private $dao;

    public function __construct(UserDAO $dao) {
        $this->dao = $dao;
    }

    public function login(string $email, string $password): ?User {
        $user = $this->dao->getUserByEmail($email);

        if ($user && hash_equals($user->getPassword(), hash('sha256', $password))) {
            $_SESSION['user_uuid'] = $user->getUUID();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['user_roles'] = $user->getRoles();
            return $user;
        }

        return null;  // Invalid login
    }
}