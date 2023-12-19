<?php

namespace App\Service;

use App\Models\Image;
use App\Models\Page;
use http\Env\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Service\ImageService;

class PageService
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getImageService()
    {
        return $this->imageService;
    }

    public function deleteSlide($page, $image)
    {
        $this->imageService->deleteImage($image);
        $page->sliders()->detach($image->id);
    }

    /**
     * Получение всех страниц.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPages()
    {
        return Page::all();
    }

    /**
     * Создание новой страницы с обработкой файлов.
     *
     * @param array $data Данные страницы.
     * @return Page
     */
    public function createPage(array $data)
    {
        $page = new Page($data);
        $this->handlePageFiles($page, $data);
        $page->save();
        return $page;
    }

    /**
     * Получение страницы по ID.
     *
     * @param int $id Идентификатор страницы.
     * @return Page
     */
    public function getPageById($id)
    {
        return Page::findOrFail($id);
    }

    /**
     * Обновление страницы.
     *
     * @param int $id Идентификатор страницы.
     * @param array $data Обновленные данные.
     * @return Page
     */
    public function updatePage($page, array $data, $sliders = null)
    {
        try {
            $page->fill($data);
            $this->handlePageFiles($page, $data, $sliders);
            $page->save();
            return $page;
        } catch (\Exception $e) {
            Log::error('Error in updatePage: ' . $e->getLine() . ' - ' . $e->getMessage() . ' ' . $e->getCode());
        }

    }

    /**
     * Удаление страницы.
     *
     * @param int $id Идентификатор страницы.
     */
    public function deletePage($id)
    {
        $page = $this->getPageById($id);
        $page->delete();
    }

    /**
     * Обработка и сохранение файлов для страницы.
     *
     * @param Page $page Страница для обработки.
     * @param array $data Данные файла.
     */
    private function handlePageFiles(Page $page, array $data, $sliders)
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $model_image = $this->imageService->saveImage($data['image'], 'pages/images', 1920,'auto');
            $page->image = $model_image->image; // Обновляем путь к изображению в модели страницы
        }

        if (isset($data['pdf_file']) && $data['pdf_file'] instanceof UploadedFile) {
            $page->pdf_file = $this->uploadFile($data['pdf_file'], 'pages/pdf');
        }

        if (isset($sliders)) {
            foreach ($sliders as $slide) {
                $model_slide = $this->imageService->saveImage($slide, 'pages/gallery', 800,'auto');
                $page->sliders()->attach($model_slide->id);
            }
        }
        $page->save();
    }


    /**
     * Загрузка файла в указанное хранилище.
     *
     * @param UploadedFile $file Файл для загрузки.
     * @param string $path Путь для сохранения файла.
     * @return string Путь к загруженному файлу.
     */
    private function uploadFile(UploadedFile $file, $path)
    {
        return $file->store($path, 'public');
    }
}
