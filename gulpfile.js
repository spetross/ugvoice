var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.sourcemaps = false;

elixir(function (mix) {
    mix
    .less('app.less')

    .scripts([
    	"../vendor/sui/serialize-object.js",
    	"../vendor/sui/semantic.js",
        "../vendor/uikit/js/core/core.js",
        "../vendor/uikit/js/core/alert.js",
        "../vendor/uikit/js/core/grid.js",
        "../vendor/uikit/js/core/modal.js",
        "../vendor/uikit/js/core/offcanvas.js",
       	"../vendor/uikit/js/core/toggle.js",
       	"../vendor/uikit/js/core/touch.js",
       	"../vendor/uikit/js/core/utility.js",
       	"../vendor/uikit/js/components/grid.js",
       	"../vendor/uikit/js/components/datepicker.js",
       	"../vendor/uikit/js/components/lightbox.js",
       	"../vendor/uikit/js/components/slider.js",
       	"../vendor/uikit/js/components/slideset.js",
       	"../vendor/uikit/js/components/slideshow.js",
       	"../vendor/uikit/js/components/sticky.js",
       	"../vendor/uikit/js/components/notify.js",
    ], "assets/js/app.js");
});
