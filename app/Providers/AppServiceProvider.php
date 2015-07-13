<?php namespace app\Providers;

use app\Support\BackendHelper;
use app\Support\FlashBag;
use app\Support\NavigationManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'app\Services\Registrar'
        );

        if ($this->app->environment() == 'local') {
            $this->app->register('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
        }

        $this->registerFlashBag();
        $this->registerBackendHelper();
        $this->registerNavigationManager();
    }

    protected function registerFlashBag()
    {
        $this->app->singleton('flash', function () {
            return new FlashBag();
        });
    }

    protected function registerBackendHelper()
    {
        $this->app->singleton('backend.helper', function () {
            return new BackendHelper;
        });
    }

    protected function registerNavigationManager()
    {
        $this->app->singleton('menu', function () {
            return new NavigationManager;
        });
    }


}
