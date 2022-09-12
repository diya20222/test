<?php namespace Folour\Flavy;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Folour\Flavy\Flavy
 */
class FlavyFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'flavy';
    }
}
