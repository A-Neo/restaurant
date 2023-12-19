<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Algoritm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'y1',
        'y2',
        'y3',
        'x1',
        'x2',
        'z1',
        'z2',
        'z3',
        'z4',
        'z5',
        'z6',
        'z7',
        'z8',
        'z9',
        'z10',
        'z11'

    ];

    public $timestamps = false;
}
