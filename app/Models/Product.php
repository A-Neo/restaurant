<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use Translatable;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title_ru',
        'title_en',
        'describe_ru',
        'describe_en',
        'description_ru',
        'description_en',
        'image',
        'image_full',
        'quantity',
        'weight',
        'price',
        'order',
        'delivery',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public $timestamps = true;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->withPivot('value');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function getImage()
    {
        if (!$this->image) {
            return asset("uploads/no-image.png");
        }
        return asset("uploads/{$this->image}");
    }

    public function getImageFull()
    {
        if (!$this->image) {
            return asset("uploads/no-image.png");
        }
        return asset("uploads/{$this->image_full}");
    }
}
