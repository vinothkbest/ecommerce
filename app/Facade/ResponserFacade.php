<?php
namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class ResponserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'responser';
    }
}
