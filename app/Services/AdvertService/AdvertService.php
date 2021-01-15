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
    /**
     * @param $dataAdvert
     * @return Advert
     */
    public function create($dataAdvert): Advert
    {
        $user = Auth::user();

        $dataAdvert['user_id'] = $user->id;

        $advert = Advert::create($dataAdvert);

        $this->addImage($dataAdvert['imageNames'], $advert->id);

        return $advert;
    }

    /**
     * @param $advert
     * @param $data
     */
    public function update($advert, $data): void
    {
        $advert->update($data->all());

        if ($data['addImages']) {
            $this->addImage($data['addImages'], $advert->id);
        }

        if ($data['deleteImages']) {
            $this->deleteImage($data['deleteImages']);
        }
    }

    /**
     * @param $advert
     */
    public function destroy($advert): void
    {
        $images = $advert->images()->get();

        foreach ($images as $image) {
            Storage::delete($image->name);
        }

        $advert->delete();
    }

    /**
     * @param $images
     * @param $id
     */
    private function addImage($images, $id): void
    {
        foreach ($images as $image) {
            Image::create([
                'name' => $image,
                'advert_id' => $id,
            ]);
        }
    }

    /**
     * @param $images
     */
    private function deleteImage($images): void
    {
        Storage::delete($images);

        foreach ($images as $image) {
            $image = Image::where('name', '=', $image);
            $image->delete();
        }
    }
}
