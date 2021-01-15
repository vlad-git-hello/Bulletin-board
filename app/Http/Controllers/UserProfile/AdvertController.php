<?php

declare(strict_types=1);

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advert\CreateRequest;
use App\Http\Requests\Advert\UpdateRequest;
use App\Models\Advert;
use App\Models\Category;
use App\Services\AdvertService\AdvertService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class AdvertController
 * @package App\Http\Controllers\UserProfile
 */
class AdvertController extends Controller
{
    /**
     * @var AdvertService
     */
    private AdvertService $service;

    /**
     * AdvertController constructor.
     *
     * @param AdvertService $service
     */
    public function __construct(AdvertService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $id = Auth::id();

        $adverts = Advert::where('user_id', '=', $id)
            ->with(['images'])
            ->orderBy('created_at', 'DESC')
            ->paginate(8);

        return view('profile.advert.index', compact('adverts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::defaultOrder()->withDepth()->get();

        $typeAuthors = Advert::getTypeAuthors();
        $stateTypes = Advert::getStateTypes();

        return view('profile.advert.create',
                    compact('categories','typeAuthors', 'stateTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $advert = $this->service->create($request->all());

        return redirect()->route('profile.advert.show', $advert);
    }

    /**
     * Display the specified resource.
     *
     * @param Advert $advert
     * @return Application|Factory|View|Response
     */
    public function show(Advert $advert)
    {
        if (!Gate::allows('view-advert', $advert)) {
            abort(403);
        }

        $user = Auth::user();

        return view('profile.advert.show', compact('advert', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Advert $advert
     * @return Application|Factory|View
     */
    public function edit(Advert $advert)
    {
        if (!Gate::allows('update-advert', $advert)) {
            abort(403);
        }

        $categories = Category::defaultOrder()->withDepth()->get();

        return view('profile.advert.edit', compact('advert', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Advert $advert
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Advert $advert): RedirectResponse
    {
        if (!Gate::allows('update-advert', $advert)) {
            abort(403);
        }

        $this->service->update($advert, $request);

        return redirect()->route('profile.advert.show', $advert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Advert $advert
     * @return RedirectResponse
     */
    public function destroy(Advert $advert): RedirectResponse
    {
        if (!Gate::allows('delete-advert', $advert)) {
            abort(403);
        }

        $this->service->destroy($advert);

        return redirect()->route('profile.advert.index')->with(['success' => $advert->title]);
    }
}
