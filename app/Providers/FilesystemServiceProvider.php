<?php namespace app\Providers;

use app\Support\Filesystem;
use Illuminate\Filesystem\FilesystemServiceProvider as FilesystemServiceProviderBase;

class FilesystemServiceProvider extends FilesystemServiceProviderBase
{

    /**
     * Register the service provider.
     * @return void
     */

    public function register()
    {
        $this->registerNativeFilesystem();

        $this->registerFlysystem();
    }

    /**
     * Register the native filesystem implementation.
     * @return void
     */
    protected function registerNativeFilesystem()
    {
        $this->app->singleton('files', function () {
            $config = $this->app['config'];
            $files = new Filesystem;
            $files->filePermissions = $config->get('site.defaultMask.file', null);
            $files->folderPermissions = $config->get('site.defaultMask.folder', null);

            return $files;
        });
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return ['files', 'filesystem'];
    }
}
