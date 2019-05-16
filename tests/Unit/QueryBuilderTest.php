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
        $this->assertEquals('SELECT * FROM products', self::$sql->select('products'));
    }

    public function testSelectColumns()
    {
        $this->assertEquals('SELECT id, name FROM products', self::$sql->select('products', ['fields' => ['id', 'name']]));
    }

    public function testSelectColumnsWithOrderBy()
    {
        $this->assertEquals('SELECT id, name FROM products ORDER BY id DESC', self::$sql->select('products', ['fields' => ['id', 'name'], 'order' => ['id DESC']]));
    }

    public function testSelectColumnsWithMultipleOrderBy()
    {
        $this->assertEquals('SELECT * FROM products ORDER BY name ASC, category ASC', self::$sql->select('products', ['order' => ['name ASC', 'category ASC']]));
    }

    public function testSelectWithCapitalizedKeywords()
    {
        $this->assertEquals('SELECT id, name FROM products ORDER BY id ASC', self::$sql->select('products', ['fields' => ['id', 'name'], 'order' => ['id ASC']]));
    }

    public function testSelectWithLimit()
    {
        $this->assertEquals('SELECT * FROM products LIMIT 10', self::$sql->select('products', ['limit' => 10]));
    }

    public function testSelectWithLimitAndOffset()
    {
        $this->assertEquals('SELECT * FROM products LIMIT 10, 5', self::$sql->select('products', ['limit' => [10, 5]]));
    }

    public function testSelectAllColumnWithCountColumn()
    {
        $this->assertEquals('SELECT *, count("id") FROM products', self::$sql->select('products', ['fields' => ['*', 'count("id")']]));
    }

    public function testSelectMaxCost()
    {
        $this->assertEquals('SELECT max("cost") FROM products', self::$sql->select('products', ['fields' => ['max("cost")']]));
    }
}
