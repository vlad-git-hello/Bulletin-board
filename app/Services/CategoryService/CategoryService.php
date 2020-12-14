<?php

declare(strict_types=1);

namespace App\Services\CategoryService;

use App\Models\Category;

/**
 * Class CategoryService
 * @package App\Services\CategoryService
 */
class CategoryService
{
    /**
     * @param $data
     * @return mixed
     */
    public function make($data)
    {
        return Category::create([
            'title' => $data['title'],
            'parent_id' => $data['category'],
        ]);
    }

    /**
     * @param $category
     * @param $data
     */
    public function edit($category, $data)
    {
        $category->update([
            'title' => $data['title'],
            'parent_id' => $data['parent'],
        ]);
    }
}
