<?php namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class RevisionRepository
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Support\Facades
 */
class RevisionRepository extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'revision.repository';
    }

}