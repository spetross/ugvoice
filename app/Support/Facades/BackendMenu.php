<?php
/**
 * Created by PhpStorm.
 * User: petross
 * Date: 6/22/15
 * Time: 2:03 PM
 */

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

class BackendMenu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * Resolves to:
     * - App\Services\NavigationManager
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'backend.menu';
    }
}