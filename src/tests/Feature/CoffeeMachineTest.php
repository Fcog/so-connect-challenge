<?php

namespace Tests\Feature;

use Domain\CoffeeMachine;
use Domain\BeansContainer;
use Domain\WaterContainer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CoffeeMachineTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        app()->bind(CoffeeMachine::class, function() {
            $beanContainer = new BeansContainer(2, 2);
            $waterContainer = new WaterContainer(50, 50);
            return new CoffeeMachine($beanContainer, $waterContainer);
        });
    }

    public function test_make_espresso()
    {
        $response = $this->post('/api/make-espresso');

        $response->assertStatus(204);
    }

    public function test_make_espresso_needs_water()
    {
        app()->bind(CoffeeMachine::class, function() {
            $beanContainer = new BeansContainer(20, 20);
            $waterContainer = new WaterContainer(50, 0);
            return new CoffeeMachine($beanContainer, $waterContainer);
        });

        $response = $this->post('/api/make-espresso');

        $response->assertStatus(503);
    }

    public function test_make_espresso_needs_beans()
    {
        app()->bind(CoffeeMachine::class, function() {
            $beanContainer = new BeansContainer(20, 0);
            $waterContainer = new WaterContainer(50, 50);
            return new CoffeeMachine($beanContainer, $waterContainer);
        });

        $response = $this->post('/api/make-espresso');

        $response->assertStatus(503);
    }

    public function test_make_double_espresso()
    {
        $response = $this->post('/api/make-double-espresso');

        $response->assertStatus(204);
    }

    public function test_get_status()
    {
        $response = $this->get('/api/status');

        $response->assertStatus(200);
        $this->assertEquals('2 Espressos left', $response->getContent());
    }

    public function test_show_status_needs_beans()
    {
        app()->bind(CoffeeMachine::class, function() {
            $beanContainer = new BeansContainer(20, 0);
            $waterContainer = new WaterContainer(50, 50);
            return new CoffeeMachine($beanContainer, $waterContainer);
        });

        $response = $this->get('/api/status');

        $response->assertStatus(200);
        $this->assertEquals('Add beans', $response->getContent());
    }

    public function test_show_status_needs_water()
    {
        app()->bind(CoffeeMachine::class, function() {
            $beanContainer = new BeansContainer(20, 20);
            $waterContainer = new WaterContainer(50, 0.01);
            return new CoffeeMachine($beanContainer, $waterContainer);
        });

        $response = $this->get('/api/status');

        $response->assertStatus(200);
        $this->assertEquals('Add water', $response->getContent());
    }

    public function test_show_status_needs_water_and_beans()
    {
        app()->bind(CoffeeMachine::class, function() {
            $beanContainer = new BeansContainer(20, 0);
            $waterContainer = new WaterContainer(50, 0.04);
            return new CoffeeMachine($beanContainer, $waterContainer);
        });

        $response = $this->get('/api/status');

        $response->assertStatus(200);
        $this->assertEquals('Add beans and water', $response->getContent());
    }
}
