<?php

namespace App\Providers;

use Domain\CoffeeMachine;
use Domain\StandardBeansContainer;
use Domain\StandardWaterContainer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class CoffeeMachineProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(CoffeeMachine::class, function() {
            $state = DB::table('coffee_machine')->first();

            if ($state) {
                $beanContainer = new StandardBeansContainer($state->num_spoons);
                $waterContainer = new StandardWaterContainer($state->litres);
            } else {
                $beanContainer = new StandardBeansContainer();
                $waterContainer = new StandardWaterContainer();
            }

            return new CoffeeMachine($beanContainer, $waterContainer);
        });
    }
}
