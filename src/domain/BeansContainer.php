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
     * @throws ContainerFullException
     */
    public function addBeans(int $numSpoons): void
    {
        if ($numSpoons > $this->getAvailableSpace()) {
            throw new ContainerFullException('The bean container will overflow with that amount of spoons.');
        }

        $this->currentNumSpoons += $numSpoons;
    }

    public function useBeans(int $numSpoons): int
    {
        $this->currentNumSpoons -= $numSpoons;

        return $numSpoons;
    }

    public function getBeans(): int
    {
        return $this->currentNumSpoons;
    }

    private function getAvailableSpace(): int
    {
       return $this->maxNumSpoons - $this->currentNumSpoons;
    }
}
