<?php
namespace Musonza\Paynow;

use Illuminate\Support\Facades\Facade;

class PaynowFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'paynow';
    }
}
