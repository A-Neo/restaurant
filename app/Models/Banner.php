<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'id',
        'title_ru',
        'title_en',
        'subtitle_ru',
        'subtitle_en',
        'btn_ru',
        'btn_en',
        'btn_link',
        'bg_image',
        'image',
        'video_link',
        'mode_bg',
        'mode_content',
        'mode_align',
        'order',
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
