<?php
/**
 * Created by PhpStorm.
 * User: petross
 * Date: 6/21/15
 * Time: 4:52 PM
 */

namespace app\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Flash extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * Resolves to:
     * - app\Support\Facades\FlashBag
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'flash';
    }
}