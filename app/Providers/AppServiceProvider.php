<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade, Carbon;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Blade extens date indonesia
        Blade::directive('date_indo', function($expression) 
        {
            return "<?php echo Carbon::parse($expression)->format('d-m-Y'); ?>";
        });

        // blade extends date time indonesia with name month 
        Blade::directive('datetime_indo_with_name_month', function($expression)
        {
        	return "<?php echo Carbon::parse($expression)->format('d F Y  |  H:i'); ?>";
        });
        
		// blade extens money indonesia
		Blade::directive('money_indo', function($expression)
		{
			return "<?php echo 'IDR '.number_format($expression, 0, ',', '.'); ?>";
		});

		// blade extens money indonesia for pengenal pembayaran
		Blade::directive('money_indo_negative', function($expression)
        {
            return "<?php echo 'IDR -'.number_format($expression, 0, ',', '.'); ?>";
        });
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
