<?php

namespace lib\models;

use lib\dao\DAO;

interface Model {
    function setDAO(DAO $dao);

}