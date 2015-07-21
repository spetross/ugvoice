<?php namespace App\Presenters;

use Laracasts\Presenter\Presenter;


/**
 * Class UserPresenter
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Presenters
 */
class UserPresenter extends Presenter
{

    /**
     * Get a user id or username
     * @return string
     */
    public function getId()
    {
        if($this->entity->username)
            return strtolower($this->entity->username);
        return $this->entity->id;
    }

    /**
     * Get the user's name.
     *
     * @return string
     */
    /**
     * Format user fullname correctly
     *
     * @return string
     */
    public function fullName()
    {
        $name = (String) $this->entity->name;
        return ucwords($name);
    }



    public function getAvatar($size = 50)
    {
        $char = strtolower(substr($this->entity->name, 0, 1));
        if ($this->entity->avatar)
            return $this->avatar->getThumb($size, $size);
        else
            return asset('assets/img/avatar/' . $char . '/' . $size . '.png');
    }

    /**
     * Get the user's security history.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function securityHistory()
    {
        /** @var \Illuminate\Database\Eloquent\Collection $history */
        $history = $this->entity->security()->get();

        $history->each(function ($item) {
            $item->security = true;
        });

        return $this->presenter->decorate($history);
    }

    /**
     * Get the user's action history.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function actionHistory()
    {
        $history = $this->entity->actions()->get();

        return $this->presenter->decorate($history);
    }

    public function isAuthor()
    {
        $author = app('App\\Repositories\\GroupRepository')->findByName('Author');
        return $this->entity->inGroup($author);
    }


}