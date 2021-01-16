<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $categories = Category::get()->toTree();

        $adverts = Advert::with(['images', 'user'])
            ->orderBy('created_at', 'DESC')
            ->paginate(8)
            ->loadMorph('user', [
                User::class => ['city'],
            ]);

        return view('home.index', compact('categories', 'adverts'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function search($id): Renderable
    {
        $adverts = Advert::where('category_id', '=' , $id)
            ->with(['images', 'user'])
            ->orderBy('created_at', 'DESC')
            ->paginate(8)
            ->loadMorph('user', [
                User::class => ['city'],
            ]);

        return view('home.search', compact('adverts'));
    }
}
