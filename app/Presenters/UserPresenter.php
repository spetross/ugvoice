<?php namespace app\Presenters;

use Laracasts\Presenter\Presenter;


/**
 * Class UserPresenter
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package app\Presenters
 */
class UserPresenter extends Presenter
{


    /**
     * Get the user's name.
     *
     * @return string
     */
    public function name()
    {
        return $this->entity->first_name . ' ' . $this->wrappedObject->last_name;
    }


    public function photo()
    {
        if ($this->entity->avatar) {
            return $this->wrappedObject->avatar->path;
        }
        return asset('img/nophoto_user_thumb_icon.png');
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


}