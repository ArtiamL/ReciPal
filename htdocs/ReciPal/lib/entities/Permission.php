<?php

namespace lib\entities;

class Permission {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }
}