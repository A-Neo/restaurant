<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryZone extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public $timestamps = true;

    /**
     * Связь зоны доставки с рестораном.
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Проверяет, попадает ли заданный адрес в зону доставки.
     */
    public function isInZone($addressCoordinates): bool
    {
        // Реализация проверки принадлежности адреса к зоне доставки
        return true;
    }

    /**
     * Рассчитывает стоимость доставки на основе расстояния и суммы заказа.
     */
    public function calculateDeliveryCost($distance, $orderAmount): float
    {
        // Реализация расчета стоимости доставки
        return true;
    }

    /**
     * Преобразует строку координат в массив.
     */
    public function getDeliveryZone()
    {
        return response()->json($this);
    }

    /**
     * Преобразует строку координат в массив.
     */
    public function getCoordinatesAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Сохраняет массив координат в виде JSON строки.
     */
    public function setCoordinatesAttribute($value)
    {
        $this->attributes['coordinates'] = json_encode($value);
    }
}
