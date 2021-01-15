<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegisterService\RegisterService;
use Illuminate\Http\RedirectResponse;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /**
     * @var RegisterService
     */
    private RegisterService $service;

    /**
     * RegisterController constructor.
     * @param RegisterService $service
     */
    public function __construct(RegisterService $service)
    {
        $this->middleware('guest');
        $this->service = $service;
    }

    /**
     * Show register from.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Show after registration message for confirm email.
     */
    public function confirmRegistration()
    {
        return view('auth.confirm-register');
    }

    /**
     * Registration new user.
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->service->register($request->all());

        return redirect()->route('registration.confirm');
    }
}
