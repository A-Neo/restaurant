<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public $timestamps = true;

    /**
     * Получение URL основного изображения.
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset("uploads/{$this->image}") : asset("uploads/no-image.png");
    }

    /**
     * Получение URL миниатюры изображения.
     *
     * @return string
     */
    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail_path ? asset("uploads/{$this->thumbnail_path}") : asset("uploads/no-image.png");
    }

    /**
     * Отношение к продукту.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Мутатор для атрибута 'path'.
     *
     * @param string $value
     */
    public function setPathAttribute($value)
    {
        $this->attributes['path'] = strtolower($value);
    }

    /**
     * Мутатор для атрибута 'thumbnail_path'.
     *
     * @param string $value
     */
    public function setThumbnailPathAttribute($value)
    {
        $this->attributes['thumbnail_path'] = strtolower($value);
    }
}
