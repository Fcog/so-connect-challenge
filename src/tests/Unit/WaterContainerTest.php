<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Domain\Exceptions\ContainerFullException;
use Domain\WaterContainer;
use Tests\TestCase;

class WaterContainerTest extends TestCase
{
    use RefreshDatabase;

    public function test_water_qty_is_removed_correctly()
    {
        $container = new WaterContainer(2, 2);

        $container->useWater(0.05);

        $this->assertEquals(1.95, $container->getWater());
    }

    public function test_water_qty_is_added_correctly()
    {
        $container = new WaterContainer(2, 2);

        $container->useWater(2);

        $container->addWater(2);

        $this->assertEquals(2, $container->getWater());
    }

    public function test_water_container_is_full()
    {
        $this->expectException(ContainerFullException::class);

        $container = new WaterContainer(2, 2);

        $container->addWater(1);
    }

    public function test_water_container_is_full_when_adding_more()
    {
        $this->expectException(ContainerFullException::class);

        $container = new WaterContainer(2, 2);

        $container->useWater(0.05);

        $container->addWater(0.05);

        $container->addWater(1);
    }
}
