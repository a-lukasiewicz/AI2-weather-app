<?php

namespace App\Controller;

use App\Service\WeatherUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherApiController extends AbstractController
{
    #[Route('/weather/api', name: 'app_weather_api', methods: ['GET', 'POST'])]
    public function weatherJsonAction(Request $request, WeatherUtil $weatherUtil): Response
    {
        $payload = $request->toArray();
        $result = $weatherUtil->getWeatherForCountryAndCity($payload['country'], $payload['city']);

        $res = [];
        if ($payload['type'] == 'json') {
            foreach ($result as $weather) {
                $res = [
                    "celsius" => $weather->getTemperature(),
                    "humidity" => $weather->getHumidity(),
                    "conditions" => $weather->getConditions(),
                    "wind_velocity" => $weather->getWindVelocity(),
                    "fahrenheit" => $weather->getFahrenheit(),
                ];
            }
            return new JsonResponse($res);
        }

        if ($payload['type'] == 'csv') {
            $csv = "";
            foreach ($result as $weather) {
                $res = [
                    "celsius" => $weather->getTemperature(),
                    "humidity" => $weather->getHumidity(),
                    "conditions" => $weather->getConditions(),
                    "fahrenheit" => $weather->getFahrenheit(),
                ];
                $csv .= implode(',', $res) . "\n";
            }
            return new Response($csv);
        }
    }

    //#[Route('/weather/api/{type}', name: 'app_weather_api_csvson', methods: ['GET','POST'])]
    public function weatherTwigAction(WeatherUtil $weatherUtil, $type, $country, $city): Response
    {
        $result = $weatherUtil->getWeatherForCountryAndCity($country, $city);

        return $this->render("weather_api/weather.{$type}.twig", [
            "country" => $country,
            "city" => $city,
            "weathers" => $result,
        ]);
    }
}
