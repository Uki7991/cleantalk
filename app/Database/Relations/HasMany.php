<?php

namespace App\Database\Relations;

class HasMany
{
    public function __construct(
        readonly string $mainClass,
        readonly string $mainId,
        readonly string $relationClass,
        readonly string $foreignKey,
        readonly string $primaryKey
    )
    {
    }

    private function getQuery()
    {
        foreach (db()->fetchAllAssociative("SELECT relation.* FROM ". (new $this->relationClass)->table . " relation LEFT JOIN ". (new $this->mainClass)->table ." main ON relation.". $this->foreignKey ." = main.". $this->primaryKey ." WHERE main.id = ? ORDER BY relation.id", [$this->mainId]) as $item) {
            yield new $this->relationClass($item);
        }
    }

    public function get()
    {
        $data = [];

        foreach ($this->getQuery() as $item) {
            $data[] = $item;
        }

        return $data;
    }
}