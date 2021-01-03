<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendRequest;
use App\Services\Auth\VerificationService\VerificationService;
use Illuminate\Http\RedirectResponse;

/**
 * Class VerificationController
 * @package App\Http\Controllers\Auth
 */
class VerificationController extends Controller
{
    /**
     * @var VerificationService
     */
    private VerificationService $serve;

    /**
     * VerificationController constructor.
     * @param VerificationService $service
     * @return void
     */
    public function __construct(VerificationService $service)
    {
        $this->serve = $service;
    }

    /**
     * Show form for resend mail.
     */
    public function show()
    {
        return view('auth.verify');
    }

    /**
     * Verify email.
     *
     * @param $token
     * @return RedirectResponse
     */
    public function verify(string $token): RedirectResponse
    {
        try {
            $this->serve->verify($token);
            return redirect()->route('login')->with('success', 'Your e-mail is verified. You can now login.');
        } catch (\DomainException $e) {
            return redirect()->route('login')->with('error', 'Sorry your link cannot be identified.');
        }
    }

    /**
     * Resend mail message.
     *
     * @param ResendRequest $request
     * @return RedirectResponse
     */
    public function resend(ResendRequest $request): RedirectResponse
    {
        try {
            $this->serve->resend($request['email']);
            return redirect()->back()->with('success', 'Email sent.');
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', 'Incorrect e-mail.');
        }
    }
}
