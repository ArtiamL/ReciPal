<?php
declare(strict_types=1);

namespace controllers;

use lib\models\PostModel;
use models\Model;

class PostController{
    private PostModel $model;


    public function __construct(PostModel $model){
        $this->model = $model;
    }

    public function getCuratedPostShort() {
        $post = $this->model->getPosts(true);

    }

    function injectModel(Model $model)
    {

    }
}