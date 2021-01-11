<?php

declare(strict_types=1);

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UserEditRequest;
use App\Models\Locality\City;
use App\Models\User;
use App\Services\ProfileService\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

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
     * ProfileController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        $imageUrl = Storage::url($user['photo']);

        return view('profile.user.show', compact('user', 'imageUrl'));
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        $cities = City::all();

        return view('profile.user.edit', compact('user', 'cities'));
    }

    /**
     * @param UserEditRequest $request
     * @param User $user
     * @return Application|Factory|View
     */
    public function update(UserEditRequest $request, User $user)
    {
        $this->service->updateUser($request, $user);

        $imageUrl = Storage::url($user['photo']);

        return view('profile.user.show', compact('user', 'imageUrl'));
    }
}
