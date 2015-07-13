<?php namespace app\Http\Controllers;


abstract class FrontController extends AppController
{

    public function __construct()
    {
        if (\Auth::check()) {
            view()->share('auth', \Auth::user());
        }
        $this->theme = \Theme::uses('ace');
    }

}