<?php

namespace App\Services\DbFind;

use Illuminate\Support\Facades\DB;

abstract class AbstractDbFind
{
    public function dbFind(string $searchBarValue, string $table, array $columns, $autocomplete = null)
    {
        $statement = $this->createStatement($searchBarValue, $table, $columns, ['slug']);
        $models = $this->findModels($statement, $table);
        foreach ($models as &$model) {
            $model->route  = route('place', ['slug' => $model->slug]);
            unset($model->slug, $model->Relevance);
        }
        return $models;
    }

    public function createStatement($searchBarValue, $table, $columns, $selectCols = [])
    {
        $r = 'Relevance';
        $columnsStr = implode(',', $columns);
        $selectColsStr = implode(',', $selectCols);
        $where = "MATCH ($columnsStr) AGAINST ('$searchBarValue' IN NATURAL LANGUAGE MODE)";
        $select = $where . " AS $r,$columnsStr" . ($selectCols ? ",$selectColsStr" : "");
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
