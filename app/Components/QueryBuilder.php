<?php

namespace App\Components;

class QueryBuilder 
{
	protected $query;

	/**
	* The select function accept the $table and $attributes variable
	* $attributes has following array options
	* $attributes = [
	*					'fields' => ['columnA', 'columnb'], // or ['*', count(columnA)]
	*					'order' => ['columnA ASC' , 'columnB DESC'],
	*					'limit' => [], // it can be an array or numeric value, numeric value used for limit and array
	*	 								having 2 values used and limit and offset
	*					joins' => [
	*								'table' => 'tableB',
	*								'type' => '', // it can be LEFT RIGHT OR blank
	*								'conditions' => [
	*									'tableA.column = tableB.column',
	*								],
	*							]
	*				]
	*
	*/

	public function select($table, array $attributes = []) {

		$fields = '*';
		
		if (!empty($attributes['fields'])) {
            $fields = implode(', ', $attributes['fields']);
        }

        $this->query = "SELECT $fields FROM $table";

        /*Check that if order by clause need to add*/
        if(isset($attributes['joins'])) {
        	$this->joins($attributes['joins']);
        }

        /*Check that if order by clause need to add*/
        if(isset($attributes['order'])) {
        	$this->orderBy($attributes['order']);
        }
        
        /*Check that if limit clause need to add*/
        if(isset($attributes['limit'])) {
        	$this->limit($attributes['limit']);
        }

        /*Check that if group by clause need to add*/
        if(isset($attributes['group'])) {
        	$this->group($attributes['group']);
        }
        return $this->query;        
    }

    private function orderBy($order)
    {
		if (!empty($order)) {
            $this->query .= ' ORDER BY '.implode(', ', $order);
        }
    }

    private function limit($limit)
    {
		if (!empty($limit)) {
            $_limit = (is_array($limit)) ? implode(', ', $limit) : $limit;
        	$this->query .=' LIMIT '.$_limit;
        }
    }

    private function group($group)
    {
		if (!empty($group)) {
            $_group = (is_array($group)) ? implode(', ', $group) : $group;
        	$this->query .=' GROUP BY '.$_group;
        }
    }

    private function joins($joins)
    {
		if (!empty($joins)) {
            $_join = [];
            $_join[] = ($joins['type']) ? ' '.$joins['type'].' JOIN' : ' JOIN';
            $_join[] = $joins['table'].' ON';
            $_join[] = $joins['conditions'];
        	$join = implode(' ', $_join);
        	$this->query .= $join;
        }
    }
} 