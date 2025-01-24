<?php
declare(strict_types=1);

namespace controllers;

interface ControllerInterface {
    function injectModel(Model $model);
}