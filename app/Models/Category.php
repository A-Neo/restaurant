<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use Translatable;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title_ru',
        'title_en',
        'slug',
        'type',
        'order',
    ];

    public $timestamps = true;

    public function foods()
    {
        return $this->belongsToMany(Food::class);
    }

    public function beverages()
    {
        return $this->belongsToMany(Beverage::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
