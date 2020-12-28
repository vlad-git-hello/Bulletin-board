<?php

/**
 * This...
 */

declare(strict_types=1);

namespace App\Services\AdvertService;

use App\Models\Advert;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Class AdvertService
 * @package App\Services\AdvertService
 */
class AdvertService
{
    public function create($dataAdvert)
    {
        $user = Auth::user();

        $dataAdvert['user_id'] = $user->id;

        $advert = Advert::create($dataAdvert);

        $this->addImage($dataAdvert['imageNames'], $advert->id);

        return $advert;
    }

    public function update($advert, $data)
    {
        $advert->update($data->all());

        if ($data['addImages']) {
            $this->addImage($data['addImages'], $advert->id);
        }

        if ($data['deleteImages']) {
            $this->deleteImage($data['deleteImages']);
        }
    }

    public function destroy($advert)
    {
        $images = $advert->images()->get();

        foreach ($images as $image) {
            Storage::delete($image->name);
        }

        $advert->delete();
    }

    private function addImage($images, $id)
    {
        foreach ($images as $image) {
            Image::create([
                'name' => $image,
                'advert_id' => $id,
            ]);
        }
    }

    private function deleteImage($images)
    {
        Storage::delete($images);

        foreach ($images as $image) {
            $image = Image::where('name', '=', $image);
            $image->delete();
        }
    }
}
