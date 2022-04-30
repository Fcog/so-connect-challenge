<?php

namespace Domain;

use Domain\Contracts\BeansContainer as BeansContainerInterface;
use Domain\Contracts\WaterContainer as WaterContainerInterface;
use Domain\Contracts\EspressoMachineInterface;
use Domain\Exceptions\NoBeansException;
use Domain\Exceptions\NoWaterException;

class CoffeeMachine implements EspressoMachineInterface
{
    const ESPRESSO_NUM_SPOONS = 1;
    const ESPRESSO_LITRES = 0.05;

    const DOUBLE_ESPRESSO_NUM_SPOONS = 2;
    const DOUBLE_ESPRESSO_LITRES = 0.10;

    public function __construct(
        private BeansContainerInterface $beansContainer,
        private WaterContainerInterface $waterContainer
    )
    {
    }

    /**
     * @throws NoBeansException
     * @throws NoWaterException
     */
    public function makeEspresso(): float
    {
        return $this->brew(self::ESPRESSO_NUM_SPOONS, self::ESPRESSO_LITRES);
    }

    /**
     * @throws NoBeansException
     * @throws NoWaterException
     */
    public function makeDoubleEspresso(): float
    {
        return $this->brew(self::DOUBLE_ESPRESSO_NUM_SPOONS, self::DOUBLE_ESPRESSO_LITRES);
    }

    /**
     * @throws NoWaterException
     * @throws NoBeansException
     */
    private function brew(int $numSpoons, float $litres): float
    {
        if ($this->beansContainer->getBeans() < $numSpoons) {
            throw new NoBeansException('There is not enough beans.');
        }

        if ($this->waterContainer->getWater() < $litres) {
            throw new NoWaterException('There is not enough water.');
        }

        $this->beansContainer->useBeans($numSpoons);
        $this->waterContainer->useWater($litres);

        return $litres;
    }

    public function getStatus(): string
    {
        if ($this->beansContainer->getBeans() === 0 && $this->waterContainer->getWater() === 0.0) {
            return 'Add beans and water';
        }

        if ($this->beansContainer->getBeans() === 0) {
            return 'Add beans';
        }

        if ($this->waterContainer->getWater() === 0.0) {
            return 'Add water';
        }

        return $this->getEspressosLeft() . ' Espressos left';
    }

    private function getEspressosLeft(): int
    {
        $leftWithBeansAvailable = $this->beansContainer->getBeans() / self::ESPRESSO_NUM_SPOONS;
        $leftWithWaterAvailable = $this->waterContainer->getWater() / self::ESPRESSO_LITRES;

        return min($leftWithBeansAvailable, $leftWithWaterAvailable);
    }

    public function getWaterContainer(): WaterContainerInterface
    {
        return $this->waterContainer;
    }

    public function getBeansContainer(): BeansContainerInterface
    {
        return $this->beansContainer;
    }
}
