<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->VaiTro !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        return $next($request);
    }


}
