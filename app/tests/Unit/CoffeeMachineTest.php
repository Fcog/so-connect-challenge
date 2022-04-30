<?php

namespace Tests\Unit;

use Domain\BeansContainer;
use Domain\CoffeeMachine;
use Domain\Exceptions\NoBeansException;
use Domain\Exceptions\NoWaterException;
use Domain\StandardBeansContainer;
use Domain\StandardWaterContainer;
use Domain\WaterContainer;
use Tests\TestCase;

class CoffeeMachineTest extends TestCase
{
    public function test_make_espresso(): void
    {
        $beansContainer = new StandardBeansContainer();
        $waterContainer = new StandardWaterContainer();
        $coffeeMachine = new CoffeeMachine($beansContainer, $waterContainer);

        $litresMade = $coffeeMachine->makeEspresso();

        $this->assertEquals(0.05, $litresMade);
    }

    public function test_make_double_espresso(): void
    {
        $beansContainer = new StandardBeansContainer();
        $waterContainer = new StandardWaterContainer();
        $coffeeMachine = new CoffeeMachine($beansContainer, $waterContainer);

        $litresMade = $coffeeMachine->makeDoubleEspresso();

        $this->assertEquals(0.10, $litresMade);
    }

    public function test_make_double_espresso_fails_with_no_beans(): void
    {
        $this->expectException(NoBeansException::class);

        $beansContainer = new BeansContainer(10, 0);
        $waterContainer = new WaterContainer(2, 2);
        $coffeeMachine = new CoffeeMachine($beansContainer, $waterContainer);

        $coffeeMachine->makeDoubleEspresso();
    }

    public function test_make_double_espresso_fails_with_no_water(): void
    {
        $this->expectException(NoWaterException::class);

        $beansContainer = new BeansContainer(10, 2);
        $waterContainer = new WaterContainer(2, 0);
        $coffeeMachine = new CoffeeMachine($beansContainer, $waterContainer);

        $coffeeMachine->makeDoubleEspresso();
    }

    public function test_show_status_add_beans_and_water(): void
    {
        $beansContainer = new BeansContainer(10, 0);
        $waterContainer = new WaterContainer(2, 0);
        $coffeeMachine = new CoffeeMachine($beansContainer, $waterContainer);

        $this->assertEquals('Add beans and water', $coffeeMachine->getStatus());
    }

    public function test_show_status_add_beans(): void
    {
        $beansContainer = new BeansContainer(10, 0);
        $waterContainer = new WaterContainer(2, 2);
        $coffeeMachine = new CoffeeMachine($beansContainer, $waterContainer);

        $this->assertEquals('Add beans', $coffeeMachine->getStatus());
    }

    public function test_show_status_add_water(): void
    {
        $beansContainer = new BeansContainer(10, 6);
        $waterContainer = new WaterContainer(2, 0);
        $coffeeMachine = new CoffeeMachine($beansContainer, $waterContainer);

        $this->assertEquals('Add water', $coffeeMachine->getStatus());
    }

    public function test_show_status_espressos_left_with_low_water(): void
    {
        $beansContainer = new BeansContainer(10, 10);
        $waterContainer = new WaterContainer(2, 0.10);
        $coffeeMachine = new CoffeeMachine($beansContainer, $waterContainer);

        $this->assertEquals('2 Espressos left', $coffeeMachine->getStatus());
    }

    public function test_show_status_espressos_left_with_low_coffee(): void
    {
        $beansContainer = new BeansContainer(10, 3);
        $waterContainer = new WaterContainer(2, 2);
        $coffeeMachine = new CoffeeMachine($beansContainer, $waterContainer);

        $this->assertEquals('3 Espressos left', $coffeeMachine->getStatus());
    }
}
