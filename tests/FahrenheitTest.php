<?php

// namespace App\Tests;

use App\Entity\Measurements;
use PHPUnit\Framework\TestCase;

class FahrenheitTest extends TestCase
{
    /** @test */
    public function isConversionCorrect(): void
    {
        $measurement = new Measurements();
        $measurement->setTemperature(25);

        $fahrenheit = $measurement->getFahrenheit();
        $this->assertEquals(79, $fahrenheit);
    }

    public function dataProvider()
    {
        return [
            [10, 20],
            [15, 40],
            [10, 34],
            [21, 23],
            [25, 78],
            [20, 68],
        ];
    }
}
