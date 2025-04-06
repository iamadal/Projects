<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider {
    public function register(): void {
        
    }

    public function boot(): void {
        RateLimiter::for('global', function (Request $request) {
            return Limit::perMinute(60)->response(function (Request $request, array $headers) {
            return response('RLE', 429, $headers);
    });
});
    }
}
