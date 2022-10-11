<?php

namespace App\Entity;

use App\Repository\WeatherDataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherDataRepository::class)]
class WeatherData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(nullable: true)]
    private ?int $temperature_celsius = null;

    #[ORM\Column(nullable: true)]
    private ?int $humidity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $weather_conditions = null;

    #[ORM\Column(nullable: true)]
    private ?int $wind = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTemperatureCelsius(): ?int
    {
        return $this->temperature_celsius;
    }

    public function setTemperatureCelsius(?int $temperature_celsius): self
    {
        $this->temperature_celsius = $temperature_celsius;

        return $this;
    }

    public function getHumidity(): ?int
    {
        return $this->humidity;
    }

    public function setHumidity(?int $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getWeatherConditions(): ?string
    {
        return $this->weather_conditions;
    }

    public function setWeatherConditions(?string $weather_conditions): self
    {
        $this->weather_conditions = $weather_conditions;

        return $this;
    }

    public function getWind(): ?int
    {
        return $this->wind;
    }

    public function setWind(?int $wind): self
    {
        $this->wind = $wind;

        return $this;
    }
}
