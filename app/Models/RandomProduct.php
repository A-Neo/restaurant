<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category_id'
    ];

    public $timestamps = false;
}
