<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Service\ImageService;


class ImageController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function store(ImageUploadRequest $request)
    {
        $mainImagePath = $this->imageService->saveImage($request->file('image'), 'images/', 800, 400);

        $newImage = Image::create([
            'path' => $mainImagePath,
            'thumbnail_path' => $thumbnailPath,
        ]);

        return new ImageResource($newImage);
    }
}
