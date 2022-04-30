<?php

namespace Domain;

final class StandardWaterContainer extends WaterContainer
{
    const MAX_LITRES = 2;

    public function __construct(float $currentLitres = self::MAX_LITRES)
    {
        parent::__construct(self::MAX_LITRES, $currentLitres);
    }
}
