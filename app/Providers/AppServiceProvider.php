<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use AlgoliaSearch\Client;
use App\Contracts\Search;
use App\Services\AlgoliaSearch;
class AppServiceProvider extends ServiceProvider {

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
			'App\Services\Registrar'
		);
/*
		$this->app->singleton(Search::class, function(){
			$config = config('services.algolia');

			return new AlgoliaSearch(
				new Client($config['app_id'], $config['api_key'])
			);
		});
*/
	}


}
