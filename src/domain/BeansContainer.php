<?php

namespace Domain;

use Domain\Contracts\BeansContainer as BeansContainerInterface;
use Domain\Exceptions\ContainerFullException;

class BeansContainer implements BeansContainerInterface
{
    public function __construct(
        protected int $maxNumSpoons,
        protected int $currentNumSpoons
    )
    {
    }

    /**
     * Adds beans to the container
     *
     * @param int $numSpoons number of spoons of beans
     *
     * @return void
     * @throws ContainerFullException
     *
     */
    public function addBeans(int $numSpoons): void
    {
        if ($numSpoons > $this->getAvailableSpace()) {
            throw new ContainerFullException('The bean container will overflow with that amount of spoons.');
        }

        $this->currentNumSpoons += $numSpoons;
    }

    /**
     * Use $numSpoons from the container
     *
     * @param int $numSpoons number of spoons of beans
     *
     * @return int number of bean spoons used
     */
    public function useBeans(int $numSpoons): int
    {
        $this->currentNumSpoons -= $numSpoons;

        return $numSpoons;
    }

    /**
     * Returns the number of spoons of beans left in the container
     *
     * @return int
     */
    public function getBeans(): int
    {
        return $this->currentNumSpoons;
    }

    private function getAvailableSpace(): int
    {
       return $this->maxNumSpoons - $this->currentNumSpoons;
    }
}
