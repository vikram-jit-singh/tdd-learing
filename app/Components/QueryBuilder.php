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
            $order = 'ORDER BY '.implode(', ', $attributes['order']);
        }
        
        return trim("SELECT $fields FROM $table $order");
    }
} 