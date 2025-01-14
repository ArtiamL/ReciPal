<?php

namespace config\dao;
interface DAO
{
    function create($obj);

    function findById($id);

    function getAll();

    function update($obj);

    function delete($obj);
}

?>