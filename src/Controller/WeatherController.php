<?php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\WeatherData;
use App\Repository\WeatherDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    /*#[Route('/weather', name: 'app_weather')]*/
    public function cityAction(Location $city, WeatherDataRepository $weatherDataRepository): Response
    {
        $weatherData = $weatherDataRepository->findByLocation($city);

        return $this->render('weather/city.html.twig', [
            'location' => $city,
            'weatherData' => $weatherData
        ]);
    }
}
