<?php

namespace App\Providers;

use App\Post;
use App\PostCategory;
use DateTime;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		error_reporting(E_ALL ^ E_NOTICE);

		View::share('post_categories', PostCategory::all());
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
//		$this->app->bind('get')
	}
}
