<?php

declare(strict_types=1);

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UserEditRequest;
use App\Models\Locality\City;
use App\Services\ProfileService\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProfileController
 * @package App\Http\Controllers\UserProfile
 */
class ProfileController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $service;

    /**
     * ProfileController constructor
     *
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $user = Auth::user();

        return view('profile.user.index', compact('user'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit()
    {
        $user = Auth::user();
        $cities = City::all();

        return view('profile.user.edit', compact('user', 'cities'));
    }

    /**
     * @param UserEditRequest $request
     * @return RedirectResponse
     */
    public function update(UserEditRequest $request): RedirectResponse
    {
        try {
            $id = Auth::id();

            $this->service->updateUser($request, $id);

            return redirect()->route('profile.index');
        } catch (\DomainException $e) {
            return redirect()->back('error', $e->getMessage());
        }
    }
}
