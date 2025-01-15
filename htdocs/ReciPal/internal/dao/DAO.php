<?php

namespace internal\dao;
abstract class DAO
{
    protected $db;
    private $table;

    protected function __construct($db, $table)
    {
        $this->db = $db;

        $this->table = $table;
    }

    abstract function create($obj);

    protected function findById($id): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    protected function getAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    abstract function update($obj); // TODO: decide implementation. Should all fields be updated or only ones passed?

    protected function delete($obj)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $obj->id);
        $stmt->execute();
    }
}

?>