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
elixir(function(mix) {
	mix.sass('admin/dashboard.scss', 'public/css/dashboard.css')
		.sass('web/balin.scss', 'public/css/balin.css')
		.scripts(['global/jquery.js', 
				'global/bootstrap.min.js', 
				'admin/dynamicForm.js', 
				'admin/metisMenu.min.js'
				], 'public/js/dashboard.js')
		.scripts(['global/jquery.js', 
				'global/bootstrap.min.js'
				], 'public/js/balin.js')
		.version(['public/css/dashboard.css', 
				'public/css/balin.css',
				'public/js/dashboard.js',
				'public/js/balin.js'])
		.copy('resources/assets/fonts', 'public/build/fonts/')
		.copy('resources/assets/plugins/', 'public/plugins/')
		.copy('resources/assets/images/', 'public/images/');
});