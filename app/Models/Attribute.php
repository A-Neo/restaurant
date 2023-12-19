<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'id',
        'title_ru',
        'title_en',
    ];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsToMany(Product::class, 'attribute_product')->withPivot('value');
    }
}
