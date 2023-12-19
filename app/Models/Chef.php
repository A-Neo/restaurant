<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'id',
        'title_ru',
        'title_en',
        'description_ru',
        'description_en',
        'image',
    ];

    public $timestamps = true;

    public function getImage()
    {
        if (!$this->image) {
            return asset("uploads/no-image.png");
        }
        return asset("uploads/{$this->image}");
    }
}
