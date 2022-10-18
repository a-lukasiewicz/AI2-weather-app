<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $ID_LOCALIZATION = null;

    #[ORM\ManyToOne(inversedBy: 'location')]
    private ?WeatherData $weatherData = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getIDLOCALIZATION(): ?string
    {
        return $this->ID_LOCALIZATION;
    }

    public function setIDLOCALIZATION(string $ID_LOCALIZATION): self
    {
        $this->ID_LOCALIZATION = $ID_LOCALIZATION;

        return $this;
    }

    public function getHumidity(): ?WeatherData
    {
        return $this->humidity;
    }

    public function setHumidity(?WeatherData $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getWeatherData(): ?WeatherData
    {
        return $this->weatherData;
    }

    public function setWeatherData(?WeatherData $weatherData): self
    {
        $this->weatherData = $weatherData;

        return $this;
    }
}
