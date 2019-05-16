<?php

namespace Tests\Unit;

use Tests\ParentTestClass;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Components\QueryBuilder as QueryBuilderComponent;

class QueryBuilderTest extends ParentTestClass
{
	private static $sql;

	public static function setUpBeforeClass() {
        self::$sql = new QueryBuilderComponent;
    }

	public function testSelectAll()
    {
        $this->assertEquals('select * from products', self::$sql->select('products'));
    }

    public function testSelectColumns()
    {
        $this->assertEquals('select id, name from products', self::$sql->select('products', ['fields' => ['id', 'name']]));
    }

    public function testSelectColumnsWithOrderBy()
    {
        $this->assertEquals('select id, name from products order by id desc', self::$sql->select('products', ['fields' => ['id', 'name'], 'order' => ['id desc']]));
    }

    public function testSelectColumnsWithMultipleOrderBy()
    {
        $this->assertEquals('select * from products order by name asc, category asc', self::$sql->select('products', ['order' => ['name asc', 'category asc']]));
    }
}
