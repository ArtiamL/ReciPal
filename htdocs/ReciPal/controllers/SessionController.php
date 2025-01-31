<?php

namespace controllers;

use lib\models\AuthModel;

class SessionController
{
//    private UserDAO $userDAO;
//    private RoleDAO $roleDAO;

    private AuthModel $authModel;

    public function __construct(AuthModel $authModel) {
        $this->authModel = $authModel;
    }

    public function login() {
        session_start();

//        echo print_r($_POST, true);

        $data = !empty($_POST) ? $_POST : json_decode(file_get_contents("php://input"));

        if (empty($data["email"]) || empty($data["password"])) {
            http_response_code(400);
            echo json_encode(["Error" => "Missing Credentials"]);
        }

        $user = $this->authModel->login($data["email"], $data["password"]);

        if ($user) {
            http_response_code(200);
            error_log("Login Successful");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
//            echo json_encode(["Message" => "Logged In", "User" => $user->getEmail()]);
        } else {
            http_response_code(400);
            echo json_encode(["Error" => "Invalid Credentials"]);
        }
        exit();

    }

//    public function login(array $request) {
//        $email = $request['email'] ?? '';
//        $password = $request['password'] ?? '';
//
//        $user = $this->authService->login($email, $password);
//
//        if ($user) {
//            echo json_encode(["message" => "Login successful", "user" => $user->email]);
//        } else {
//            http_response_code(401);
//            echo json_encode(["error" => "Invalid credentials"]);
//        }
//    }

//    public function logout() {
//        $this->authService->logout();
//        echo json_encode(["message" => "Logout successful"]);
//    }
}