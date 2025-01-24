<?php
declare(strict_types=1);

namespace controllers;

use models\Model;

class PostController {

    private Model $model;

    public function setModel(Model $model): void {
        $this->model = $model;
    }

    public function getCuratedPostShort() {
        $post = $this->model->getCuratedPosts();

    }
}