<?php
namespace CodePress\CodeCategory\Controllers;

use CodePress\CodeCategory\Repository\CategoryRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    private $repository;
    private $response;

    public function __construct(ResponseFactory $response, CategoryRepository $repository)
    {
        $this->repository = $repository;
        $this->response = $response;
    }

    public function index()
    {
        $categories = $this->repository->all();
        return $this->response->view('codecategory::index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->repository->all();
        return $this->response->view('codecategory::create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return $this->response->redirectToRoute('admin.categories.index');
    }

    public function edit($id)
    {
        $category = $this->repository->find($id);
        $categories = $this->repository->all();
        return $this->response->view('admin.categories.edit', compact('categories', 'category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['active'] = isset($data['active']);

        if (! isset($data['parent_id']) || (! isset($data['parent_id']) && $data['parent_id'] == $id)) {
            $data['parent_id'] = null;
        }

        $this->repository->update($data, $id);

        return $this->response->redirectToRoute('admin.categories.index');
    }

}