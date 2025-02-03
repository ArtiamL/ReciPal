<?php

namespace controllers;

use lib\entities\User;
use lib\models\AuthModel;

class SessionController
{
    private AuthModel $authModel;

    public function __construct(AuthModel $authModel) {
        $this->authModel = $authModel;
//        header('Content-type: application/json');
    }

    public function login() {
        $input = file_get_contents('php://input');
        var_dump("Input: " . $input);

        $data = !empty($_POST) ? $_POST : json_decode($input, true);

        error_log("SessionController->login(), line 20: " . var_export($data, true));

        if (empty($data["email"]) || empty($data["password"])) {
            http_response_code(400);
            echo json_encode(["Error" => "Missing Credentials"]);
        }

        $user = $this->authModel->login($data["email"], $data["password"]);

        error_log("SessionController->login, after calling authmodel: " . var_export($user, true));

        if ($user) {
            // Set session variables
            $_SESSION['user_uuid'] = $user->getUUID();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['user_roles'] = $user->getRoles();

            // Return '200 OK' to user
            http_response_code(200);
            // Redirect to referring page.
            error_log("Referrer: " . $_SERVER['HTTP_REFERER']);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            error_log("Login Successful");
            echo json_encode(["Message" => "Logged in Successfully!"]);
        } else {
            http_response_code(400);
            echo json_encode(["Error" => "Invalid Credentials"]);
        }
    }

    public function logout() {
        unset($_SESSION);
        session_destroy();
        http_response_code(200);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function register() {
        $data = !empty($_POST) ? $_POST : json_decode(file_get_contents("php://input"));

        if (count(array_filter($data, fn($item) => empty($item)))) {
            http_response_code(400);
            return json_encode(["Error" => "Missing Information"]);
        }

        $userRegistered = json_decode($this->authModel->register($data), true);

        if ($userRegistered['code'] === 500) {
            http_response_code(500);
            return json_encode($userRegistered);
        }

        http_response_code(200);
        $this->login();
        return json_encode($userRegistered);
    }

    public function deleteUser() {
        $user = $_SESSION['user_uuid'];

        if (!$this->authModel->deleteUser($user)) {
            http_response_code(500);
            return json_encode(["Error" => "Failed to Delete User!"]);
        }

        http_response_code(200);
        $this->logout();
        return json_encode(["Message" => "User Deleted Successfully!"]);
    }
}