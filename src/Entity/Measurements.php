<?php

namespace App\Entity;

use App\Repository\MeasurementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeasurementsRepository::class)]
class Measurements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    #[ORM\Column(nullable: true)]
    private ?int $temperature = null;

    #[ORM\Column(nullable: true)]
    private ?int $humidity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $conditions = null;

    #[ORM\Column(nullable: true)]
    private ?int $windVelocity = null;

    #[ORM\Column(nullable: true)]
    private ?string $fahrenheit = null;

    // public function __construct()
    // {
    //     $this->location = new ArrayCollection();
    // }

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
        $this->location->$location;
        return $this;
    }

    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    public function setTemperature(?int $temperature): self
    {
        $this->temperature = $temperature;

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

    public function getConditions(): ?string
    {
        return $this->conditions;
    }

    public function setConditions(?string $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function getWindVelocity(): ?int
    {
        return $this->windVelocity;
    }

    public function setWindVelocity(?int $windVelocity): self
    {
        $this->windVelocity = $windVelocity;

        return $this;
    }

    public function getFahrenheit(): ?string
    {
        return strval(intval($this->temperature) * 1.8 + 32);
    }

    // public function __toString()
    // {
    //     return strval($this->id);
    // }
}
