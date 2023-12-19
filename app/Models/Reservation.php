<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'id',
        'title_ru',
        'title_en',
        'description_ru',
        'description_en',
    ];

    public $timestamps = true;
}
