<?php

declare(strict_types=1);

namespace App\Services\ProfileService;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserService
 * @package App\Services\ProfileService
 */
class UserService
{
    /**
     * @param $data
     * @param User $user
     */
    public function updateUser($data, User $user): void
    {
        $updateData = [
            'name' => $data['name'],
            'contact_name' => $data['contact_name'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'city_id' => $data['city_id'],
        ];

        if ($data['password']) {
            $updateData['password'] = User::hashPassword($data['password']);
        }

        if ($data['photo']) {
            $updateData['photo'] = $this->saveStoragePhoto($data);
        }

        $user->update($updateData);
    }

    private function saveStoragePhoto($data)
    {
        return Storage::put('', $data->file('photo'));
    }
}
