<?php

namespace Domain;

final class StandardBeansContainer extends BeansContainer
{
    const MAX_NUM_SPOONS = 50;

    public function __construct(int $currentNumSpoons = self::MAX_NUM_SPOONS)
    {
        parent::__construct(self::MAX_NUM_SPOONS, $currentNumSpoons);
    }
}
