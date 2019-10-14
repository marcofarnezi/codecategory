<?php
namespace CodePress\Tests\CodeCategory\Models;

use CodePress\CodeCategory\Models\Category;
use CodePress\CodeCategory\Tests\AbstractTestCase;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;


class CategoryTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->migrate();

    }

    public function test_inject_validator_in_category_model()
    {
        $category = new Category();
        $validator = \Mockery::mock(Validator::class);
        $category->setValidator($validator);

        $this->assertEquals($category->getValidator(), $validator);
    }

    public function test_check_if_category_can_be_persisted()
    {
        $category = Category::create([
           'name' => 'Category Test',
            'active' => false
        ]);

        $this->assertEquals('Category Test', $category->name);
    }

    public function test_check_if_is_possible_associete_pattern_to_category()
    {
        $parentCategory = Category::create([
            'name' => 'Parent Test',
            'active' => true
        ]);

        $category = Category::create([
            'name' => 'Category Test',
            'active' => true
        ]);

        $category->parent()->associate($parentCategory)->save();
        $child = $parentCategory->children->first();
        $this->assertEquals('Category Test', $child->name);
        $this->assertEquals('Parent Test', $category->parent->name);
    }

    public function test_should_check_if_it_is_invalid_when_it_is()
    {
        $category = new Category();
        $category->name = 'Category Test';

        $messageBag = \Mockery::mock(MessageBag::class);

        $validator = \Mockery::mock(Validator::class);
        $validator->shouldReceive('setRules')->with(['name' => 'required|max:255']);
        $validator->shouldReceive('setData')->with(['name' => 'Category Test']);
        $validator->shouldReceive('fails')->andReturn(true);
        $validator->shouldReceive('errors')->andReturn($messageBag);

        $category->setValidator($validator);

        $this->assertFalse($category->isValid());
        $this->assertEquals($messageBag, $category->errors);
    }

}