<?php

namespace controllers;

use lib\entities\User;
use lib\models\AuthModel;

class SessionController
{
    private AuthModel $authModel;

    // TODO: Make User private static field?

    public function __construct(AuthModel $authModel) {
        $this->authModel = $authModel;
        header('Content-type: application/json');
    }

    public function login() {
        $input = file_get_contents('php://input');

        $data = !empty($_POST) ? $_POST : json_decode($input, true);

        if (empty($data["email"]) || empty($data["password"])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing Credentials!"]);
        }

        $user = $this->authModel->login($data["email"], $data["password"]);

        $code = 404;

        if ($user) {
//          Set session variables.
            $_SESSION['user_uuid'] = $user->getUUID();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['user_roles'] = $user->getRoles();

            $code = 200;
        }

        self::handleHTTPResponse($code, $user);
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

        self::handleHTTPResponse($this->authModel->register($data));

        // Internal testing and when not using js fetch api.
        if ($login)
            $this->login();
    }

    public function deactivateUser() {
        self::handleHTTPResponse($this->authModel->deactivateUser($_SESSION['uuid']));
        $this->logout();
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

    private static function handleHTTPResponse($code, $user = null): void {
        switch ($code) {
            case 200:
                // Return '200 OK' to user
                http_response_code(200);
                // Redirect to referring page.
                echo json_encode([
                    "message" => "Logged in Successfully!",
                    "authenticated" => true,
                    "username" => $user->getUsername()
                ]);
                break;
            case 201:
                http_response_code(201);
                echo json_encode([
                    "message" => "Registered Successfully!",
                ]);
                break;
            case 204:
                http_response_code(204);
                echo json_encode(["message" => "User Successfully Deleted!"]);
                break;
            case 400:
                http_response_code(400);
                echo json_encode(["message" => "Invalid Credentials!"]);
                break;
            case 409:
                http_response_code(409);
                echo json_encode(["message" => "A user with that email/username already exists!"]);
                break;
            case 500:
                http_response_code(500);
                echo json_encode(["message" => "Failed to register user!"]);
                break;
            case 404:
            default:
                http_response_code(404);
                echo json_encode(["message" => "User Not Found!"]);
                break;
        }
    }
}