<?php

namespace App\Components;

class QueryBuilder 
{
	public function select($table) {
        return "select * from $table";
    }
} 