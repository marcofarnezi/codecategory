<?php
namespace CodePress\Tests\CodeCategory\Models;

use CodePress\CodeCategory\Models\Category;
use CodePress\Tests\AbstractTestCase;


class CategoryTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->migrate();

    }

    public function test_check_if_category_can_be_persisted()
    {
        $category = Category::create([
           'name' => 'Category Test',
            'active' => false
        ]);

        $this->assertEquals('Category Test', $category->name);
    }

}