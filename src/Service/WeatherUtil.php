<?php

namespace App\Service;

use App\Entity\Location;
use App\Repository\MeasurementsRepository;
use App\Repository\LocationRepository;

class WeatherUtil
{
    private $locationRepository;
    private $measurementRepository;

    public function __construct(LocationRepository $locationRepository, MeasurementsRepository $measurementRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->measurementRepository = $measurementRepository;
    }

    public function getWeatherForCountryAndCity($country, $city)
    {
        $location = $this->locationRepository->findByCountryAndCity($city, $country);
        $measurements = $this->getWeatherForLocation($location);
        $result["location"] = $location;
        $result["measurements"] = $measurements;
        return $result;
    }

    public function getWeatherForLocation($location)
    {
        $measurements = $this->measurementRepository->findByLocation($location);
        return $measurements;
    }
}
