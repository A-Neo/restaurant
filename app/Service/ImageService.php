<?php

namespace App\Service;

use App\Models\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageIntervention;
use Illuminate\Http\UploadedFile;

class ImageService
{
    /**
     * Сохраняет изображение, изменяя его размер в соответствии с указанными параметрами.
     *
     * @param UploadedFile $image Загружаемое изображение.
     * @param string $path Путь сохранения изображения.
     * @param int|null $width Желаемая ширина изображения.
     * @param int|null $height Желаемая высота изображения.
     * @param int $quality Качество сохраняемого изображения.
     * @return Image Изображение.
     */
    public function saveImage($image, $path, $width = null, $height = null, $quality = 90)
    {
        try {
            $filename = time() . '-' . mt_rand(1000000, 9999999) . '.' . $image->getClientOriginalExtension();

            $originalImage = ImageIntervention::make($image);

            $resizedBigImage = $originalImage->resize(1920, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize(); // предотвращает увеличение изображения
            });

            $originalPath = 'uploads/' . $path . '/image_' . $filename;
            $resizedBigImage->save(public_path($originalPath), $quality);

            if ($width && $height) {
                $resizedImage = $originalImage->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize(); // предотвращает увеличение изображения
                });

                $resizedPath = 'uploads/' . $path . '/resized_' . $filename;
                $resizedImage->save(public_path($resizedPath), $quality);
            }
            $model = Image::create(['image' => $path . '/image_' . $filename, 'thumbnail_path' => $path . '/resized_' . $filename]);
            return $model;
        } catch (\Exception $e) {
            Log::error('Error in ImageService: ' . $e->getMessage());
        }
    }

    public function deleteImage(Image $image)
    {
        // Удаляем файл изображения из хранилища, если он существует
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        // Удаляем запись изображения из базы данных
        $image->delete();
    }
}
