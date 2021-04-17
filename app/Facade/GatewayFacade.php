<?php
namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class GatewayFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'gateway';
    }
}
