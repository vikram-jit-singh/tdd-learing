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
        $this->assertEquals('select id, name from products', self::$sql->select('products', ['id', 'name']));
    }
}
