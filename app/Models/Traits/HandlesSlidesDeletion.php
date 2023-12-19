<?php

namespace App\Models\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

trait HandlesSlidesDeletion
{
    public function deleteSlide($model, $imageId, $imageService)
    {
        $imageService->deleteImage($imageId);
        $model->sliders()->detach($imageId);
    }
}
