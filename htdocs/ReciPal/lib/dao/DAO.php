<?php

namespace lib\dao;
abstract class DAO
{
    protected $db;
    private $tables = [
        'permissions',
        'roles',
        'users',
        'recipes',
        'user_role',
        'role_permission',
        'curated_recipes',
    ];

    protected $table;

    /**
     * @throws \Exception If table does not exist in list of tables.
     */
    protected function __construct($db, $table)
    {
        $this->db = $db;

        $this->setTable($table);
    }
    abstract function create($obj);
    abstract function update($obj); // TODO: decide implementation. Should all fields be updated or only ones passed?

    protected final function getTables(): array
    {
        return $this->table;
    }

    protected final function setTable(string $table) {
        if (!in_array($table, $this->tables)) {
            throw new \Exception("Table '$table' does not exist");
        }

        $this->table = $table;
    }

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

    protected function delete($obj)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $obj->id);
        $stmt->execute();
    }
}

?>