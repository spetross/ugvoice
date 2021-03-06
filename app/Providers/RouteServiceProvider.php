<?php namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->bind('user', function($value)
        {
            return app('App\\Repositories\\UserRepository')->findByIdUsername($value);
        });

        $router->bind('client', function ($value) {
            return app('App\\Repositories\\OrganisationRepository')->findBySlug($value);
        });

    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            $router->group(['prefix' => config('backend.uri', 'admin')], function () {
                require __DIR__ . '/../Http/backend.php';
            });

            $router->group(['prefix' => config('forum.uri', 'forum')], function () {
                require __DIR__ . '/../Http/forum.php';
            });

            require __DIR__ . '/../Http/routes.php';
        });

    }

}
