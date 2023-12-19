<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beverage extends Model
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
        'subtitle_ru',
        'subtitle_en',
        'image',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public $timestamps = true;

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

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getImage()
    {
        if (!$this->image) {
            return asset("uploads/no-image.png");
        }
        return asset("uploads/{$this->image}");
    }
}
