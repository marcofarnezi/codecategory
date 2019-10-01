<?php
namespace CodePress\CodeCategory\Controllers;

use CodePress\CodeCategory\Models\Category;
use http\Client\Response;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    private $category;
    private $response;

    public function __construct(ResponseFactory $response, Category $category)
    {
        $this->category = $category;
        $this->response = $response;
    }

    public function index()
    {
        $categories = $this->category->all();
        return $this->response->view('codecategory::index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->category->all();
        return $this->response->view('codecategory::create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->category->create($request->all());

        return $this->response->redirectToRoute('admin.categories.index');
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $categories = $this->category->all();
        return $this->response->view('admin.categories.edit', compact('categories', 'category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['active'] = isset($data['active']);

        if (! isset($data['parent_id']) || (! isset($data['parent_id']) && $data['parent_id'] == $id)) {
            $data['parent_id'] = null;
        }

        $this->category->find($id)->update($data);

        return $this->response->redirectToRoute('admin.categories.index');
    }

}