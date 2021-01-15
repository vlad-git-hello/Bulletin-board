<?php

declare(strict_types=1);

namespace App\Services\Auth\RegisterService;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

/**
 * RegisterService.
 */
class RegisterService
{
    /**
     * Create user and call event.
     * @param $data
     */
    public function register(array $data): void
    {
        $user = User::make($data);

        event(new Registered($user));
    }
}
