<?php
namespace CodePress\Tests\CodeCategory\Controllers;

use CodePress\CodeCategory\Repository\CategoryRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Routing\Controller;
use CodePress\CodeCategory\Controllers\AdminCategoryController;
use CodePress\CodeCategory\Models\Category;
use CodePress\CodeCategory\Tests\AbstractTestCase;

class AdminCategoryControllerTest extends AbstractTestCase
{
    public function test_should_extends_from_controller()
    {
        $repository = \Mockery::mock(CategoryRepository::class);
        $response = \Mockery::mock(ResponseFactory::class);
        $controller = new AdminCategoryController($response, $repository);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_run_index_method_and_return_correct_arguments()
    {
        $repository = \Mockery::mock(CategoryRepository::class);
        $response = \Mockery::mock(ResponseFactory::class);
        $controller = new AdminCategoryController($response, $repository);
        $categoryResults = ['category 1', 'category 2'];
        $html = \Mockery::mock();

        $repository->shouldReceive('all')->andReturn($categoryResults);
        $response->shouldReceive('view')
            ->with('codecategory::index', ['categories' => $categoryResults])
            ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }

    public function test_controller_should_run_create_method_and_return_correct_arguments()
    {
        $repository = \Mockery::mock(CategoryRepository::class);
        $response = \Mockery::mock(ResponseFactory::class);
        $controller = new AdminCategoryController($response, $repository);
        $categoryResults = ['category 1', 'category 2'];
        $html = \Mockery::mock();

        $repository->shouldReceive('all')->andReturn($categoryResults);
        $response->shouldReceive('view')
            ->with('codecategory::create', ['categories' => $categoryResults])
            ->andReturn($html);

        $this->assertEquals($controller->create(), $html);
    }
}