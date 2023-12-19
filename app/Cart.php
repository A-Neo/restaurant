<?php

namespace App;

class Cart {
    protected $items;
    protected $deliveryCalculator;
    protected $promoCodeManager;

    public function __construct(DeliveryCalculator $deliveryCalculator, PromoCodeManager $promoCodeManager) {
        $this->items = session()->get('cart', []);
        $this->deliveryCalculator = $deliveryCalculator;
        $this->promoCodeManager = $promoCodeManager;
    }

    public function addItem(Food $food, int $quantity) {
        // Логика добавления товара
    }

    public function updateItem(Food $food, int $quantity) {
        // Логика обновления количества товара
    }

    public function calculateTotalCost() {
        $totalCost = $this->calculateItemsCost();
        $deliveryCost = $this->deliveryCalculator->calculate($this->items);
        $discount = $this->promoCodeManager->calculateDiscount($this->items);

        return $totalCost + $deliveryCost - $discount;
    }


    public function calculateDeliveryCost($address) {
        // Используем Yandex API для получения координат
        $coordinates = $this->getCoordinatesFromAddress($address);

        // Определяем зону доставки
        $deliveryZone = $this->getDeliveryZone($coordinates);

        // Расчет стоимости доставки
        return $this->determineDeliveryCost($deliveryZone);
    }


}
