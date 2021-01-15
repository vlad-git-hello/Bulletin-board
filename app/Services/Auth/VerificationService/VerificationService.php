<?php

declare(strict_types=1);

namespace App\Services\Auth\VerificationService;

use App\Models\User;
use Illuminate\Auth\Events\Verified;

/**
 * Class VerificationService
 * @package App\Services\Auth\VerificationService
 */
class VerificationService
{
    /**
     * Verifying email.
     *
     * @param string $token
     */
    public function verify(string $token): void
    {
        if (!$user = User::where('verify_token', $token)->first()) {
            throw new \DomainException();
        }

        $user->verify();

        event(new Verified($user));
    }

    /**
     * Resend message.
     *
     * @param string $email
     */
    public function resend(string $email): void
    {
        $user = User::where('email', $email)->first();

        if (!$user || $user->hasVerifiedEmail()) {
            throw new \DomainException();
        }

        $user->refreshToken();
        $user->sendEmailVerificationNotification();
    }
}
