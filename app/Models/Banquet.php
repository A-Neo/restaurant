<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banquet extends Model
{
    use HasFactory;
    use Translatable;
    use Sluggable;
    use SoftDeletes;

    protected $guarded = [];
    public $timestamps = true;

    public function sliders()
    {
        return $this->belongsToMany(Image::class, 'banquet_slider');
    }

    public function getImage()
    {
        if (!$this->image) return asset("uploads/no-image.png");
        return asset("uploads/{$this->image}");
    }

    public function getPdf()
    {
        if (!$this->pdf_file) return asset("uploads/not.pdf");
        return asset("uploads/{$this->pdf_file}");
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_ru'
            ]
        ];
    }
}
