<?php

namespace App\Components;

class QueryBuilder 
{
	public function select($table, array $attributes = []) {

		$fields = '*';
		if (!empty($attributes['fields'])) {
            $fields = implode(', ', $attributes['fields']);
        }

        $order = '';
		if (!empty($attributes['order'])) {
            $order = 'order by '.implode(', ', $attributes['order']);
        }
        
        return trim("select $fields from $table $order");
    }
} 