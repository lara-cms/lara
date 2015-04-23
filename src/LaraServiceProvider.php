<?php namespace LaraCms\Lara;

use Illuminate\Support\ServiceProvider;

class LaraServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
            
            $this->loadViewsFrom(__DIR__.'/../views', 'lara');
          
            $this->publishes([
                __DIR__.'/../views' => base_path('resources/views/vendor/lara'),
		__DIR__.'/../public/' => base_path('/public'),
                __DIR__.'/../config/master.php' => config_path('lara_cms/master.php')

            ]);

            include __DIR__.'/../routes.php';
            //include __DIR__.'/../composer.php';
	}
        // ---
	/**
	 * Register the application services. 
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
        

}
