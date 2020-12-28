<?php

/**
 * This...
 */

declare(strict_types=1);

namespace App\Services\CategoryService\TransformService;

use App\Models\Category;

/**
 * Class TransformService
 * @package App\Services\CategoryService\TransformService
 */
class TransformService
{
    /**
     * @param Category $category
     */
    public function first(Category $category)
    {
        $first = $category->siblings()->defaultOrder()->first();

        if ($first) {
            $category->insertBeforeNode($first);
        }
    }

    /**
     * @param Category $category
     */
    public function last(Category $category)
    {
        $last = $category->siblings()->defaultOrder('desc')->first();

        if ($last) {
            $category->insertAfterNode($last);
        }
    }
}
