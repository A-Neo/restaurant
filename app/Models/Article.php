<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use Sluggable;
    use Translatable;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title_ru',
        'title_en',
        'slug',
        'description_ru',
        'description_en',
        'image',
        'form',
        'rubric',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public $timestamps = true;

    public function sliders()
    {
        return $this->belongsToMany(Image::class, 'article_slider');
    }

    public function galleries()
    {
        return $this->belongsToMany(Image::class, 'article_gallery');
    }

    public function rubrics()
    {
        return $this->hasOne(Rubric::class, 'id', 'rubric');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_ru'
            ]
        ];
    }

    public function sluggableEvent(): string
    {
        return SluggableObserver::SAVED;
    }

    public function getImage()
    {
        if (!$this->image) {
            return asset("uploads/no-image.png");
        }
        return asset("uploads/{$this->image}");
    }
}
