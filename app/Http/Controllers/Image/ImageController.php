<?php

declare(strict_types=1);

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\UploadRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

/**
 * Class ImageController
 * @package App\Http\Controllers\Image
 */
class ImageController extends Controller
{
    /**
     * @param UploadRequest $request
     * @return JsonResponse
     */
    public function store(UploadRequest $request): JsonResponse
    {
        $imageName = Storage::put('/adverts-image', $request->file('file'));

        return response()->json(['imageName' => $imageName]);
    }

    /**
     * @param $path
     * @param $imageName
     * @return JsonResponse
     */
    public function destroy($path, $imageName): JsonResponse
    {
        $imagePath = '/' . $path . '/' . $imageName;

        Storage::delete($imagePath);

        return response()->json(['success' => $imagePath]);
    }
}
