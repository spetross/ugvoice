<?php namespace App\Http\Controllers;

use App\Organisation;

class HomeController extends AppController
{

    /**
     * Show the home page.
     *
     * @return \View
     */
    public function index()
    {
        $this->setTitle('Home');
        $this->setLayout('blank', 'home');
        $this->asset()->add('home-style', 'assets/css/home.css', ['theme']);
        $this->asset()->container('footer')->add('uk-grid', 'assets/library/uikit/js/components/grid.js', ['uikit']);
        return $this->render('home', ['featured_clients' => Organisation::all()->take(4)]);
    }

    public function onRefresh()
    {

    }

}
