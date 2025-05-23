<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class admin_mws {
    public function handle(Request $request, Closure $next): Response {
        if (Auth::check() || session('xrole') == 'admin') {
            return $next($request);
        } else {
             return redirect()->route('admin_login');
        }        
    }
}
