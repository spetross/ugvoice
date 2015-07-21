<?php
namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Flash extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * Resolves to:
     * - App\Support\Facades\FlashBag
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'flash';
    }
}