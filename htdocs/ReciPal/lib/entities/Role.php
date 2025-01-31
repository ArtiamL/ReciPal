<?php

namespace lib\entities;

class Role {
    private $name;

    private $permissions = [];

    public function __construct(string $name, array $permissions = []) {
        $this->name = $name;
        $this->permissions = array_values($permissions);
    }
}