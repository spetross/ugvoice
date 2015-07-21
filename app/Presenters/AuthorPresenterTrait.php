<?php namespace App\Presenters;

/**
 * Trait AuthorPresenterTrait
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Presenters
 */
trait AuthorPresenterTrait
{
    /**
     * Get the author's name.
     *
     * @return string
     */
    public function author()
    {
        $user = $this->getWrappedObject()->user()->withTrashed()->first(['first_name', 'last_name']);

        if ($user) {
            return $user->first_name . ' ' . $user->last_name;
        }
    }
}
