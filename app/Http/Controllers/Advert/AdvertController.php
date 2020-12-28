<?php

namespace App\Http\Controllers\Advert;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advert\CreateRequest;
use App\Http\Requests\Advert\UpdateRequest;
use App\Models\Advert;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use App\Services\AdvertService\AdvertService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Class AdvertController
 * @package App\Http\Controllers\Advert
 */
class AdvertController extends Controller
{
    private AdvertService $service;

    /**
     * AdvertController constructor.
     * @param AdvertService $service
     */
    public function __construct(AdvertService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $adverts = Advert::with(['category', 'user'])
            ->orderBy('id', 'DESC')
            ->paginate(5)
            ->loadMorph('user', [
                User::class => ['city'],
            ]);

        return view('advert.index', compact('adverts'));
    }

    public function create()
    {
        $categories = Category::defaultOrder()->withDepth()->get();

        return view('advert.create', compact('categories'));
    }

    public function store(CreateRequest $request)
    {
        $advert = $this->service->create($request->all());

        return redirect()->route('advert.show', $advert);
    }

    public function show(Advert $advert)
    {
        $advert->timestamps = false;
        $advert->increment('view');

        return view('advert.show', compact('advert'));
    }

    public function edit(Advert $advert)
    {
        $categories = Category::defaultOrder()->withDepth()->get();

        return view('advert.edit', compact('advert', 'categories'));
    }

    public function update(UpdateRequest $request, Advert $advert)
    {
        $this->service->update($advert, $request);

        return view('advert.show', compact('advert'));
    }

    public function destroy(Advert $advert)
    {
        $this->service->destroy($advert);

        return redirect()->route('advert.index')->with(['success' => $advert->title]);
    }
}
