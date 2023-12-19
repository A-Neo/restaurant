<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public $timestamps = true;

    public function deliveryZones(): HasMany
    {
        return $this->hasMany(DeliveryZone::class);
    }

    /**
     * Привязывает зону доставки к ресторану.
     */
    public function addDeliveryZone($zoneData)
    {
        return $this->deliveryZones()->create($zoneData);
    }

    /**
     * Отвязывает зону доставки от ресторана.
     */
    public function removeDeliveryZone(DeliveryZone $zone)
    {
        return $zone->delete();
    }

    /**
     * Получает географические координаты ресторана через Yandex Maps API.
     */
    public function fetchCoordinatesFromApi()
    {
        // Реализация запроса к Yandex Maps API для получения координат
    }
}
