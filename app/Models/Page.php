<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, Translatable, SoftDeletes;

    protected $guarded = [];
    public $timestamps = true;

    /**
     * Получение URL изображения для страницы.
     * Используется аксессор для упрощения доступа к URL изображения.
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset("uploads/{$this->image}") : asset("uploads/no-image.png");
    }

    /**
     * Получение URL PDF файла для страницы.
     *
     * @return string
     */
    public function getPdfUrlAttribute(): string
    {
        return $this->pdf_file ? asset("uploads/{$this->pdf_file}") : '';
    }

    /**
     * Отношение "многие ко многим" между страницей и изображениями (слайдерами).
     * Ясно определяет связь между страницами и их слайдерами.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sliders()
    {
        return $this->belongsToMany(Image::class, 'page_slider', 'page_id', 'image_id');
    }

    /**
     * Скоуп для фильтрации по активным страницам.
     * Упрощает получение только активных страниц.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Дополнительные методы и отношения, соответствующие вашим бизнес-требованиям...

    /**
     * Мутатор для атрибута title.
     * Пример использования мутатора для автоматического форматирования.
     *
     * @param string $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
    }

}
