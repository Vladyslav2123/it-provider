<?php

namespace App\Livewire;

use Livewire\Component;

class CoverageMap extends Component
{
    public $searchQuery = '';
    public $searchResults = [];
    public $selectedLocation = null;
    public $isInCoverageArea = false;
    public $nearestCoverageArea = null;
    public $distance = null;

    public function search()
    {
        if (empty($this->searchQuery)) {
            return;
        }

        // In a real implementation, you would use a geocoding service like Google Maps API
        // For this example, we'll simulate search results
        $this->searchResults = [
            [
                'address' => $this->searchQuery,
                'latitude' => 50.4501,
                'longitude' => 30.5234,
            ]
        ];
    }

    public function selectLocation($index)
    {
        $this->selectedLocation = $this->searchResults[$index];
        $this->searchResults = [];
        $this->checkCoverage();
    }

    public function checkCoverage()
    {
        if (!$this->selectedLocation) {
            return;
        }

        $coverageAreas = \App\Models\CoverageArea::where('active', true)->get();

        $userLat = $this->selectedLocation['latitude'];
        $userLng = $this->selectedLocation['longitude'];

        $minDistance = null;
        $nearestArea = null;

        foreach ($coverageAreas as $area) {
            // Calculate distance using Haversine formula
            $distance = $this->calculateDistance(
                $userLat,
                $userLng,
                $area->latitude,
                $area->longitude
            );

            if ($distance <= $area->radius) {
                $this->isInCoverageArea = true;
                $this->nearestCoverageArea = $area;
                $this->distance = $distance;
                return;
            }

            if ($minDistance === null || $distance < $minDistance) {
                $minDistance = $distance;
                $nearestArea = $area;
            }
        }

        $this->isInCoverageArea = false;
        $this->nearestCoverageArea = $nearestArea;
        $this->distance = $minDistance;
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Haversine formula to calculate distance between two points on Earth
        $earthRadius = 6371; // Radius of the earth in km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) * sin($dLon/2);

        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $earthRadius * $c; // Distance in km

        return $distance;
    }

    public function render()
    {
        return view('livewire.coverage-map', [
            'coverageAreas' => \App\Models\CoverageArea::where('active', true)->get(),
        ]);
    }
}
