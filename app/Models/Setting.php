<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'id',
        'phone',
        'mail',
        'mail_two',
        'time_ru',
        'time_en',
        'delivery_ru',
        'delivery_en',
        'street_ru',
        'street_en',
        'instagram_link',
        'facebook_link',
        'tiktok_link',
        'overlay',
        'logo',
        'logo_b',
        'en_on',
        'max_distance',
    ];

    public $timestamps = true;

    public function getImage($name)
    {
        if (!$this->$name) {
            return asset("uploads/no-image.png");
        }
        return asset("uploads/{$this->$name}");
    }

    public function getImageLogo()
    {
        if (!$this->logo_b) {
            return asset("uploads/no-image.png");
        }
        return asset("uploads/{$this->logo_b}");
    }
}
