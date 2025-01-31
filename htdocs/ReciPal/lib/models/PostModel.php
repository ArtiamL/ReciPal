<?php

namespace lib\models;

use lib\dao\DAO;
use models\Model;

class PostModel {
    private $dao;

    public function __construct(DAO $dao) {
        $this->dao = $dao;
    }

    public function getPosts(bool $curated){
        $this->dao->getAll();
    }
}