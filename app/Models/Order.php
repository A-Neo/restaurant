<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'date',
        'time',
        'method',
        'wishes',
        'address',
        'total',
        'discount',
        'delivery',
        'devices',
        'payment_method',
        'payment_status'
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
