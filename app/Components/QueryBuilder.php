<?php

namespace App\Components;

class QueryBuilder 
{
	protected $query;

	public function select($table, array $attributes = []) {

		$fields = '*';
		
		if (!empty($attributes['fields'])) {
            $fields = implode(', ', $attributes['fields']);
        }

        $this->query = "SELECT $fields FROM $table";

        /*Check that if order by clause need to add*/
        $this->orderBy($attributes);
        
        /*Check that if limit clause need to add*/
        $this->limit($attributes);
        
        return $this->query;        
    }

    public function orderBy(array $attributes)
    {
		if (!empty($attributes['order'])) {
            $this->query .= ' ORDER BY '.implode(', ', $attributes['order']);
        }
    }

    public function limit(array $attributes)
    {
		if (!empty($attributes['limit'])) {
            $_limit = (is_array($attributes['limit'])) ? implode(', ', $attributes['limit']) : $attributes['limit'];
        	$this->query .=' LIMIT '.$_limit;
        }
    }
} 