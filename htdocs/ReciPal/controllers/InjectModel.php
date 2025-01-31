<?php
declare(strict_types=1);

namespace controllers;

interface InjectModel {
    function injectModel(Model $model);
}