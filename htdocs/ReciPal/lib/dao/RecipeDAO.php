<?php

namespace config\dao;

use lib\dao\DAO;

final class RecipeDAO extends DAO
{
    public function __construct(\PDO $db) {
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
}