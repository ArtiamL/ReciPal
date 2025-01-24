<?php

namespace config\dao;

use lib\dao\DAO;

final class RecipeDAO extends DAO
{
    public function __construct($db) {
        parent::__construct($db, "recipes");
    }

    function create($obj)
    {
        // TODO: Implement create() method.
    }

    function update($obj)
    {
        // TODO: Implement update() method.
    }

    public function getCuratedRecipes() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE curated_by IS NOT NULL");
    }
}