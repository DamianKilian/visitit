<?php

namespace App\Services\DbFind;

use Illuminate\Support\Facades\DB;

abstract class AbstractDbFind
{
    public function dbFind(string $searchBarValue, string $table, array $columns, $autocomplete = null)
    {
        $statement = $this->createStatement($searchBarValue, $table, $columns);
        $models = $this->findModels($statement, $table);
        return $models;
    }

    public function createStatement($searchBarValue, $table, $columns)
    {
        $r = 'Relevance';
        $columnsStr = implode(',', $columns);
        $where = "MATCH ($columnsStr) AGAINST ('$searchBarValue' IN NATURAL LANGUAGE MODE)";
        $select = $where . " AS $r,$columnsStr";
        return [
            'all' => "SELECT $select FROM $table WHERE MATCH ($columnsStr) AGAINST ('$searchBarValue' IN NATURAL LANGUAGE MODE)",
            'select' => $select,
            'where' => $where,
            'orderBy' => $r,
        ];
    }

    public function findModels($statement, $table)
    {
        return DB::table($table)
            ->selectRaw($statement['select'])
            ->whereRaw($statement['where'])
            ->orderBy($statement['orderBy'])
            ->get()->toArray();
    }
}
