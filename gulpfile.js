process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

//  var paths = {
//     adminLTE: ['vendor/almasaeed2010/adminlte/dist/'],
//     datatables: ['vendor/almasaeed2010/adminlte/plugins/datatables/'],
//     select2: ['vendor/almasaeed2010/adminlte/plugins/select2/'],
//     bootstrapEditor: ['vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5/'],
//     jquery: ['bower_components/jquery/dist/jquery.min.js'],
//     jqueryUI: ['bower_components/jquery-ui/jquery-ui.min.js'],
//     bootstrap: ['bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js'],
//     bootstrapLightboxJS: ['vendor/bootstrap-lightbox/bootstrap-lightbox.min.js'],
//     bootstrapLightboxCSS: ['vendor/bootstrap-lightbox/bootstrap-lightbox.min.css'],
// };

elixir.config.js.browserify.transformers.push({ name: 'browserify-shim', options: {}});

elixir(function(mix) {
    mix.sass('app.scss', 'public/css/app.css')
        .sass('admin.scss', 'public/css/admin.css')
        .sass('public.scss', 'public/css/public.css')
        .browserify('app.js')
        .scripts(['vendor/wow.js', 'vendor/jquery.fittext.js','vendor/creative.js'], 'public/js/vendor.js');
        // .scriptsIn("/resources/js/vendor", 'public/js/vendor.js');
    //    .copy(paths.adminLTE, 'public/vendor/adminLTE/')
    //    .copy(paths.datatables, 'public/vendor/datatables/')
    //    .copy(paths.select2, 'public/vendor/select2/')
    //    .copy(paths.bootstrapEditor, 'public/vendor/bootstrap-wysihtml5/')
    //    .copy(paths.jquery, 'public/js/')
    //    .copy(paths.jqueryUI, 'public/js/')
    //    .copy(paths.bootstrap, 'public/js/')
    //    .copy(paths.bootstrapLightboxJS, 'public/js/')
    //    .copy(paths.bootstrapLightboxCSS, 'public/css/');
});
