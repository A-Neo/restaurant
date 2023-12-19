<?php

namespace App;

class KMLParser
{
    private $xml;

    public function __construct($filePath)
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new \Exception("File not found or not readable: " . $filePath);
        }

        $this->xml = simplexml_load_file($filePath);
    }

    public function parseDeliveryZones()
    {
        $zones = [];
        foreach ($this->xml->Document->Folder->Placemark as $placemark) {
            $zone = [
                'name' => (string)$placemark->name,
                'coordinates' => $this->extractCoordinates((string)$placemark->Polygon->outerBoundaryIs->LinearRing->coordinates)
            ];
            array_push($zones, $zone);
        }
        return $zones;
    }

    private function extractCoordinates($coordinateString)
    {
        $coordinates = explode(' ', trim($coordinateString));
        return array_map(function ($coordinate) {
            $parts = explode(',', $coordinate);
            return ['latitude' => floatval($parts[1]), 'longitude' => floatval($parts[0])];
        }, $coordinates);
    }
}
