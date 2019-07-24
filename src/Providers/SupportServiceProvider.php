<?php

namespace Laravel\Support\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SupportServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->bootBladeDirectives();
        $this->bootMacros();
    }

    private function bootBladeDirectives()
    {
        // Add @optional for Complex Yielding
        Blade::directive('optional', static function($expression) {
            return "<?php if (\$yield = trim(\$__env->yieldContent({$expression}))): ?>";
        });

        // Add @endoptional for Complex Yielding
        Blade::directive('endoptional', static function($expression) {
            return "<?php endif; ?>";
        });
    }

    private function bootMacros()
    {
        // Add Route::if('route.name', 'is-active') for simpler styling
        Route::macro('if', function(...$patterns) {
            $true = array_pop($patterns);
            return Route::is(...$patterns) ? $true : '';
        });
    }
}
