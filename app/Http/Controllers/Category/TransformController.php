<?php

declare(strict_types=1);

namespace App\Http\Controllers\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Services\CategoryService\TransformService\TransformService;
use Illuminate\Http\RedirectResponse;

/**
 * Class TransformController
 * @package App\Http\Controllers\Category
 */
class TransformController extends Controller
{
    /**
     * @var TransformService
     */
    private $service;

    /**
     * TransformController constructor.
     * @param TransformService $service
     */
    public function __construct(TransformService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function up(Category $category)
    {
        $category->up();

        return redirect()->route('category.index');
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function down(Category $category)
    {
        $category->down();

        return redirect()->route('category.index');
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function first(Category $category)
    {
        $this->service->first($category);

        return redirect()->route('category.index');
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function last(Category $category)
    {
        $this->service->last($category);

        return redirect()->route('category.index');
    }
}
