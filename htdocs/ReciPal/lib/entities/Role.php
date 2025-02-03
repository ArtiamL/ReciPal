<?php

namespace lib\entities;

class Role {
    private $name;

    private $permissions = [];

    public function __construct(string $name, array $permissions = []) {
        $this->name = $name;
        $this->permissions = $permissions;
    }

    public function getName(): string {
        return $this->name;
    }

    public function addPermissions(array $permissions) {
        $this->permissions = $permissions;
    }

    public function getPermissions() {
        return $this->permissions;
    }
}