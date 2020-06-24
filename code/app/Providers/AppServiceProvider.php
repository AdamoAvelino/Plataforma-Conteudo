<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('dateBr', function ($timestamp) {
            return "<?php echo date('d/m/Y', strtotime($timestamp));  ?>";
        });

        Blade::directive('hora', function ($timestamp) {
            return "<?php echo date('H:i', strtotime($timestamp));  ?>";
        });
        Blade::directive('statusCheck', function ($valor) {
            return "<?php echo $valor ? 'checked' : '';  ?>";
        });

        Blade::directive('statusSelect', function ($valor) {
            return "<?php echo $valor ? 'selected' : '';  ?>";
        });

        Blade::directive('classActive', function ($active) {
            return "<?php echo $active ? 'badge-success' : 'badge-danger';  ?>";
        });

        Blade::directive('statusActive', function ($active) {
            return "<?php echo $active ? 'Ativo' : 'Inativo';  ?>";
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
