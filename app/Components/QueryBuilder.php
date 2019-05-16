<?php

namespace App\Components;

class QueryBuilder 
{
	public function select($table, array $columns = []) {

		$fields = '*';
		if (!empty($columns)) {
            $fields = implode(', ', $columns);
        }

        return "select $fields from $table";
    }
} 