<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_ru' => 'required|string|max:255',
            'title_en' => 'sometimes|string|max:255',
            'title_gallery' => 'sometimes',
            'subtitle_ru' => 'sometimes',
            'subtitle_en' => 'sometimes',
            'description_ru' => 'sometimes',
            'description_en' => 'sometimes',
            'image' => 'sometimes', // макс. размер файла 5MB
            'pdf_file' => 'sometimes', // макс. размер файла 10MB
            'pdf_ru' => 'sometimes',
            'pdf_en' => 'sometimes',
            'sliders' => 'sometimes',
            'meta_title' => 'sometimes',
            'meta_description' => 'sometimes',
            'meta_keywords' => 'sometimes',
        ];
    }

    public function messages()
    {
        return [
            'title_ru.required' => 'Поле "Название (RU)" обязательно для заполнения.',
            'title_ru.string' => 'Поле "Название (RU)" должно быть строкой.',
            'title_ru.max' => 'Поле "Название (RU)" не должно превышать 255 символов.',
            'title_en.string' => 'Поле "Название (EN)" должно быть строкой.',
            'title_en.max' => 'Поле "Название (EN)" не должно превышать 255 символов.',
            'subtitle_ru.string' => 'Поле "Подзаголовок (RU)" должно быть строкой.',
            'subtitle_ru.max' => 'Поле "Подзаголовок (RU)" не должно превышать 255 символов.',
            'subtitle_en.string' => 'Поле "Подзаголовок (EN)" должно быть строкой.',
            'subtitle_en.max' => 'Поле "Подзаголовок (EN)" не должно превышать 255 символов.',
            'description_ru.string' => 'Поле "Описание (RU)" должно быть строкой.',
            'description_en.string' => 'Поле "Описание (EN)" должно быть строкой.',
            'image.file' => 'Загруженный файл должен быть файлом.',
            'image.image' => 'Файл должен быть изображением.',
            'image.max' => 'Размер изображения не должен превышать 5MB.',
            'sliders.file' => 'Загруженный файл должен быть файлом.',
            'pdf_file.file' => 'Загруженный файл должен быть файлом.',
            'pdf_file.mimes' => 'Файл должен быть документом формата PDF.',
            'pdf_file.max' => 'Размер PDF файла не должен превышать 10MB.',
            'pdf_ru.string' => 'Поле "PDF (RU)" должно быть строкой.',
            'pdf_ru.max' => 'Поле "PDF (RU)" не должно превышать 255 символов.',
            'pdf_en.string' => 'Поле "PDF (EN)" должно быть строкой.',
            'pdf_en.max' => 'Поле "PDF (EN)" не должно превышать 255 символов.',
            'meta_title.string' => 'Поле "Мета-заголовок" должно быть строкой.',
            'meta_description.string' => 'Поле "Мета-описание" должно быть строкой.',
            'meta_keywords.string' => 'Поле "Мета-ключевые слова" должно быть строкой.',
        ];
    }

    public function attributes()
    {
        return [
            'title_ru' => 'Название (RU)',
            'title_en' => 'Название (EN)',
            'subtitle_ru' => 'Подзаголовок (RU)',
            'subtitle_en' => 'Подзаголовок (EN)',
            'description_ru' => 'Описание (RU)',
            'description_en' => 'Описание (EN)',
            'image' => 'Изображение',
            'sliders' => 'Галерея',
            'pdf_file' => 'PDF файл',
            'pdf_ru' => 'PDF (RU)',
            'pdf_en' => 'PDF (EN)',
            'meta_title' => 'Мета-заголовок',
            'meta_description' => 'Мета-описание',
            'meta_keywords' => 'Мета-ключевые слова',
        ];
    }

}
