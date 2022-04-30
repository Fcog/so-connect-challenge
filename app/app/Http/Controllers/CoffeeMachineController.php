<?php

namespace App\Http\Controllers;

use Domain\CoffeeMachine;
use \Domain\Exceptions\EspressoMachineException;
use Illuminate\Support\Facades\DB;

class CoffeeMachineController extends Controller
{
    public function getStatus(CoffeeMachine $coffeeMachine)
    {
        return $coffeeMachine->getStatus();
    }

    public function makeEspresso(CoffeeMachine $coffeeMachine)
    {
        try {
            $coffeeMachine->makeEspresso();

            DB::table('coffee_machine')->updateOrInsert(
                [
                    'id' => 1,
                ],
                [
                    'num_spoons' => $coffeeMachine->getBeansContainer()->getBeans(),
                    'litres' => $coffeeMachine->getWaterContainer()->getWater(),
                ]
            );

            $statusCode = 204;
        } catch (EspressoMachineException) {
            $statusCode = 503;
        }

        return response('', $statusCode);
    }

    public function makeDoubleEspresso(CoffeeMachine $coffeeMachine)
    {
        try {
            $coffeeMachine->makeDoubleEspresso();

            DB::table('coffee_machine')->updateOrInsert(
                [
                    'id' => 1,
                ],
                [
                    'num_spoons' => $coffeeMachine->getBeansContainer()->getBeans(),
                    'litres' => $coffeeMachine->getWaterContainer()->getWater(),
                ]
            );

            $statusCode = 204;
        } catch (EspressoMachineException) {
            $statusCode = 503;
        }

        return response('', $statusCode);
    }
}
