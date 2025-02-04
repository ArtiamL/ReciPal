<?php

namespace config\dao;

use lib\dao\DAO;
use lib\dao\UserDAO;

final class RecipeDAO extends DAO
{
    public function __construct(\PDO $db) {
        parent::__construct($db, "recipes");
    }

    function create(Recipe $recipe, UserDAO $dao): bool {
        try {
            // Use transaction for full rollback on fail with insertion into multiple tables.
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("SELECT u.user_id FROM users u WHERE u.user_uuid = :uuid");
            $stmt->bindParam(":uuid", $recipe->getAuthorUUID());
            $stmt->execute();
            $uID = $stmt->fetchColumn();

            $stmt = $this->db->prepare("INSERT INTO `{$this->table}` (`created_by`, `title`, `recipe_desc`, `instructions`) VALUES (:author, :title, :desc, :instructions)");
            $stmt->bindParam(":author", $uID);
            $stmt->bindParam(":title", $recipe->getTitle());
            $stmt->bindParam(":desc", $recipe->getDescription());
            $stmt->bindParam(":instructions", $recipe->getInstructions());
            $stmt->execute();
            $lastInsertId = $this->db->lastInsertId();

            $stmt = $this->db->prepare("SELECT i.ingredient_id FROM ingredients i WHERE i.ingredient_name in :ingredients");
            $stmt->bindParam(":ingredients", $recipe->getIngredients());
            $stmt->execute();
            $ingredientIDs = $stmt->fetchAll();

            $stmt = $this->db->prepare("INSERT INTO `recipe_ingredients` (`recipe_id`, `ingredient_id`, `quantity`, `unit`) VALUES (:recipe_id, :ingredient_id, :quantity, :unit)");

            foreach ($ingredientIDs as $ingredientID) {
                $stmt->bindParam(":recipe_id", $lastInsertId);
                $stmt->bindParam(":ingredient_id", $ingredientID);
                $stmt->bindParam(":quantity", $recipe->getIngredientQuantity());
                $stmt->bindParam(":unit", $recipe->getIngredientUnit());
                $stmt->execute();
            }

            $this->db->commit();

            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    function update($obj)
    {
        // TODO: Implement update() method.
    }

    public function setCurated($recipe) {

    }

    public function getPostFromCriteria(array $criteria) {
        $stmt = $this->db->prepare("SELECT r.created_by, r.title, r.recipe_desc, r.instructions, r.date_created, u.user_uuid, ri.quantity, ri.unit, i.ingredient_name, i.allergen, ai.alternative_ingredient_id
            FROM `{$this->table}` r
            LEFT JOIN curated_recipes cr on r.recipe_id = cr.recipe_id
            LEFT JOIN users u on cr.curator_id = u.user_id
            LEFT JOIN recipe_ingredients ri on r.recipe_id = ri.recipe_id
            LEFT JOIN ingredients i on ri.ingredient_id = i.ingredient_id
            LEFT JOIN alternative_ingredients ai on i.ingredient_id = ai.alternative_ingredient_id
            WHERE r.deleted IS 0;
            GROUP BY r.recipe_id;");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}