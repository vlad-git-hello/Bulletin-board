<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\UploadRequest;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(UploadRequest $request)
    {
        $imageName = Storage::put('', $request->file('file'));

        return  response()->json(['imageName' => $imageName]);
    }

    public function destroy($imageName)
    {
        Storage::delete($imageName);

        return  response()->json(['success' => $imageName]);
    }
}
