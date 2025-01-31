<?php
declare(strict_types=1);

namespace controllers;

use models\Model;

class PostController{
    private Model $model;


    public function __construct(Model $model){
        $this->model = $model;
    }

    public function getCuratedPostShort() {
        $post = $this->model->getCuratedPosts();

    }

    function injectModel(Model $model)
    {

    }
}