<?php

declare(strict_types=1);

namespace App\Http\Controllers\Category;

use App\Services\CategoryService\CategoryService;
use App\Http\Requests\Category\{CreateRequest, EditRequest};
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\RedirectResponse;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $service;

    /**
     * CategoryController constructor.
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $categories = Category::defaultOrder()->withDepth()->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $categories = Category::defaultOrder()->withDepth()->get();

        return view('categories.create', compact('categories'));
    }

    /**
     * @param CreateRequest $request
     * @return Factory|View
     */
    public function store(CreateRequest $request)
    {
        $category = $this->service->make($request);

        return view('categories.show', compact('category'));
    }

    /**
     * @param Category $category
     * @return Factory|View
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * @param Category $category
     * @return Factory|View
     */
    public function edit(Category $category)
    {
        $parents = Category::defaultOrder()->withDepth()->get();

        return view('categories.edit', compact('category', 'parents'));
    }

    /**
     * @param EditRequest $request
     * @param Category $category
     * @return Factory|View
     */
    public function update(EditRequest $request, Category $category)
    {
        $this->service->edit($category, $request);

        return view('categories.show', compact('category'));
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with(['success' => $category->title]);
    }
}
