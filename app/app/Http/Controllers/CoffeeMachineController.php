<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Domain\CoffeeMachine;
use \Domain\Exceptions\EspressoMachineException;

class CoffeeMachineController extends Controller
{
    public function getStatus()
    {
        return app(CoffeeMachine::class)->getStatus();
    }

    public function makeEspresso()
    {
        try {
            app(CoffeeMachine::class)->makeEspresso();
            $statusCode = 204;
        } catch (EspressoMachineException) {
            $statusCode = 503;
        }

        return response('', $statusCode);
    }

    public function makeDoubleEspresso()
    {
        try {
            app(CoffeeMachine::class)->makeDoubleEspresso();
            $statusCode = 204;
        } catch (EspressoMachineException) {
            $statusCode = 503;
        }

        return response('', $statusCode);
    }
}
