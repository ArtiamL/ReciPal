<?php

namespace controllers;

use lib\entities\User;
use lib\models\AuthModel;

class SessionController
{
    private AuthModel $authModel;

    public function __construct(AuthModel $authModel) {
        $this->authModel = $authModel;
        header('Content-type: application/json');
    }

    public function login() {
        $input = file_get_contents('php://input');

        $data = !empty($_POST) ? $_POST : json_decode($input, true);

        error_log("SessionController->login(), line 20: " . var_export($data, true));

        if (empty($data["email"]) || empty($data["password"])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing Credentials!"]);
        }

        $user = $this->authModel->login($data["email"], $data["password"]);

        if ($user) {
//             Set session variables.
            $_SESSION['user_uuid'] = $user->getUUID();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['user_roles'] = $user->getRoles();

            // Return '200 OK' to user
            http_response_code(200);
            // Redirect to referring page.
            echo json_encode([
                "message" => "Logged in Successfully!",
                "authenticated" => true,
                "username" => $user->getUsername()
            ]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Invalid Credentials!"]);
        }
    }

    public function logout() {
        unset($_SESSION);
        session_destroy();
        http_response_code(200);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function checkSession() {
        if (!isset($_SESSION['user_uuid'])) {
            http_response_code(401);
            echo json_encode(["message" => "Session Expired or Invalid!", "authenticated" => false]);
        }

        http_response_code(200);
        echo json_encode(["message" => "Authenticated Successfully!",
            "authenticated" => true,
            "username" => $_SESSION['username']
        ]);
    }

    public function register($login = false): void {
        $data = !empty($_POST) ? $_POST : json_decode(file_get_contents("php://input"));

        if (count(array_filter($data, fn($item) => empty($item)))) {
            http_response_code(400);
            echo json_encode(["message" => "Missing Information!"]);
        }

        $data['active'] = true;

        switch ($this->authModel->register($data)) {
            case 201:
                http_response_code(201);
                echo json_encode([
                    "message" => "Registered Successfully!",
                ]);
                break;
            case 409:
                http_response_code(401);
                echo json_encode(["message" => "A user with that email/username already exists!"]);
                break;
            case 500:
                http_response_code(500);
                echo json_encode(["message" => "Failed to register user!"]);
                break;
        }

        // Internal testing and when not using js fetch api.
        if ($login)
            $this->login();
    }

    public function deleteUser() {
        $user = $_SESSION['user_uuid'];

        if (!$this->authModel->deleteUser($user)) {
            http_response_code(500);
            return json_encode(["message" => "Failed to Delete User!"]);
        }

        http_response_code(200);
        $this->logout();
        return json_encode(["message" => "User Deleted Successfully!"]);
    }
}