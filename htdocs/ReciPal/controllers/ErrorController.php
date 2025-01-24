<?php

namespace controllers;

class ErrorController
{
    public function show404() {
        http_response_code(404);
    }
}