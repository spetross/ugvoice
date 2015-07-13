<?php namespace app\Http\Controllers;

use app\Organisation;

class HomeController extends AppController
{

    /**
     * Show the home page.
     *
     * @return \View
     */
    public function index()
    {
        $this->title = 'Home';
        $this->layout = 'blank';
        $this->asset()->add('home_style', 'assets/css/home.css', ['uikit']);
        $this->asset()->container('footer')->add('uk-grid', 'assets/library/uikit/js/components/grid.js', ['uikit']);
        return $this->render('home', ['featured_clients' => Organisation::all()->take(4)]);
    }

    public function onRefresh()
    {

    }

}
