<?php
/**
 * Created by PhpStorm.
 * User: petross
 * Date: 6/22/15
 * Time: 1:28 AM
 */

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Backend extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * Resolves to:
     * - App\Support\BackendHelper
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'backend.helper';
    }
}