<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'id',
        'title_ru',
        'title_en',
        'subtitle_ru',
        'subtitle_en',
        'description_ru',
        'description_en',
        'describe_ru',
        'describe_en',
        'btn_ru',
        'btn_en',
        'btn_link',
        'bg_image',
        'image',
    ];

    public $timestamps = true;

    public function getImage($originName)
    {
        if (!$this->$originName) {
            return asset("uploads/no-image.png");
        }
        return asset("uploads/{$this->$originName}");
    }
}
