<?php

namespace Tests\Unit;

use Tests\ParentTestClass;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Components\QueryBuilder as QueryBuilderComponent;

class QueryBuilderTest extends ParentTestClass
{
	public function testSelectAll()
    {
        $sql = new QueryBuilderComponent;
        $this->assertEquals('select * from products', $sql->select('products'));
    }
}
