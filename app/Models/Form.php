<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'max_human',
        'max_date',
        'max_time',
        'type'
    ];

    public $timestamps = false;
}
