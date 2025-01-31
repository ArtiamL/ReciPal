<?php

namespace lib\middlewares;

class AuthMiddleware
{
    public static function handle(array $allowedRoles): void
    {
        session_start();

        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
            http_response_code(401);
            echo json_encode(["error" => "Unauthorized access."]);
            exit;
        }

        if (!in_array($_SESSION['role'], $allowedRoles)) {
            http_response_code(403);
            echo json_encode(["error" => "Forbidden"]);
            exit;
        }
    }
}