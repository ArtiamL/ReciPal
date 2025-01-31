<?php

namespace config\dao;

use lib\dao\DAO;

class CuratedPostDAO extends DAO
{
    public function __construct($db) {
        parent::__construct($db, "curated_recipes");
    }
    public function create($obj)
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (recipe_id, curator_id) VALUES (:recipe_id, :curator_id)");
        $stmt->bindParam(":recipe_id", $obj->getRecipeId());
        $stmt->bindParam(":curator_id", $obj->getCuratorId());
        $stmt->execute();
    }

    function update($obj)
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET ")
    }
}