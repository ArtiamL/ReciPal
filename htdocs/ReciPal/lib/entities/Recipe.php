<?php

namespace config\entities;

use config\dao\RecipeDAO;
use lib\entities\User;

final class Recipe extends Entity {
    protected $id;

    private $author, $curator, $title, $desc, $instructions, $date;

    public function __construct(...$args) {

    }
}