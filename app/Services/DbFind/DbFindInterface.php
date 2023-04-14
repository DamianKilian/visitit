<?php

namespace App\Services\DbFind;

interface DbFindInterface
{
    /**
     * Search for records in MySql table.
     * 
     * @param string $searchBarValue
     * @param string $table
     * @param array $columns
     * @param object $autocomplete Autocomplete service to save autocomplete phrases
     * 
     * @return array
     *
     */
    public function dbFind(string $searchBarValue, string $table, array $columns, $autocomplete = null);
}
