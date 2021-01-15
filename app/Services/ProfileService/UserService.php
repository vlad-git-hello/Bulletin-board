<?php

declare(strict_types=1);

namespace App\Services\ProfileService;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserService
 * @package App\Services\ProfileService
 */
class UserService
{
    /**
     * @param $data
     * @param $id
     */
    public function updateUser(Request $data, int $id): void
    {
        /** @var User $user */
        $user = User::findOrFail($id);
        $updateData = $this->preparationData($data, $user);
        $user->update($updateData);
    }

    /**
     * @param $data
     * @param $user
     * @return array
     */
    private function preparationData($data, $user): array
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
            $newPhoto = $data->file('photo');
            $updateData['photo'] = $this->updateStoragePhoto($newPhoto, $user);
        }

        return $updateData;
    }

    /**
     * @param $newPhoto
     * @param $user
     * @return bool
     */
    private function updateStoragePhoto($newPhoto, $user)
    {
        /** @var User $user */

        if (!$user->hasDefaultPhoto()) {
            Storage::delete($user->photo);
        }

        return Storage::put('/profile', $newPhoto);
    }
}
