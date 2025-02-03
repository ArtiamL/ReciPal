<?php

namespace lib\models;

use config\dao\RecipeDAO;

class PostModel {
    private $dao;

    public function __construct(RecipeDAO $dao) {
        $this->dao = $dao;
    }

    public function getPosts(bool $curated): ?Post {
        $this->dao->getAll();
    }
}