let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.autoload({
    jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery","window.jquery"]
  })
  .js('resources/assets/js/app.js', 'public/js')
  .webpackConfig({
    output: {
        chunkFilename: 'js/[name].js',
        publicPath: '/'
    }
  })
  .version()
  .extract(['jquery', 'bootstrap-sass', 'slimscroll', 'smoothscroll', 'vue', 'admin-lte', 'icheck'])
  .sass('resources/assets/sass/app.scss', 'public/css')
  .less('node_modules/bootstrap-less/bootstrap/bootstrap.less', 'public/css/bootstrap.css')
  .less('resources/assets/less/adminlte-app.less','public/css/adminlte-app.css')
  .less('node_modules/toastr/toastr.less','public/css/toastr.css')
  .combine([
    'public/css/app.css',
    'public/css/adminlte-app.css',
    'node_modules/icheck/skins/square/blue.css',
    'public/css/toastr.css'
    ], 'public/css/all.css'
  )
  //APP RESOURCES
  .copy('resources/assets/images/*.*','public/img')
  //VENDOR RESOURCES
  .copy('node_modules/font-awesome/fonts/*.*','public/fonts/')
  .copy('node_modules/ionicons/dist/fonts/*.*','public/fonts/')
  .copy('node_modules/admin-lte/bootstrap/fonts/*.*','public/fonts/bootstrap')
  .copy('node_modules/admin-lte/dist/css/skins/*.*','public/css/skins')
  .copy('node_modules/admin-lte/dist/img','public/img')
  .copy('node_modules/admin-lte/plugins','public/plugins')
  .copy('node_modules/icheck/skins/square/blue.png','public/css')
  .copy('node_modules/icheck/skins/square/blue@2x.png','public/css');

