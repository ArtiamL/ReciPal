<?php

namespace controllers;

class TestController
{
    private $str;

    public function __construct($str) {
        $this->str = $str;
    }

    public function test(): void {
        echo "<p>Hello world!</p>";
        echo "<p>This is a test!</p>";
        echo $this->str;
    }
}