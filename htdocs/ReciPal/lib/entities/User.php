<?php

namespace lib\entities;

class User {
    private $UserID;
    private $UUID;
    private $email;
    private $passwordHash;
    private $isActive;

    public function __construct($UserID, $UUID, $email, $passwordHash, $isActive) {
        $this->UserID = $UserID;
        $this->UUID = $UUID;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->isActive = $isActive;
    }

    public function getUserID() {
        return $this->UserID;
    }

    public function getUUID() {}
}