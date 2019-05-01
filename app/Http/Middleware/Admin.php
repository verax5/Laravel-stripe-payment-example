<?php

namespace App\Http\Middleware;

use Closure;

class Admin {
    public function handle($request, Closure $next) {
        if (! auth()->guard('admin')->user()) {
            return redirect()->to('/');
        }

        return $next($request);
    }
}
