<?php

namespace Domain;

use Domain\Contracts\WaterContainer as WaterContainerInterface;
use Domain\Exceptions\ContainerFullException;

class WaterContainer implements WaterContainerInterface
{
    public function __construct(
        private float $maxLitres,
        private float $currentLitres
    )
    {
    }

    /**
     * @throws ContainerFullException
     */
    public function addWater(float $litres): void
    {
        if ($litres > $this->getAvailableSpace()) {
            $this->currentLitres = $this->maxLitres;

            throw new ContainerFullException('The water container is full.');
        }

        $this->currentLitres += $litres;
    }

    public function useWater(float $litres): float
    {
        $this->currentLitres -= $litres;

        return $litres;
    }

    public function getWater(): float
    {
        return $this->currentLitres;
    }

    private function getAvailableSpace(): float
    {
        return $this->maxLitres - $this->currentLitres;
    }
}
