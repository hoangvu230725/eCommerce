<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckNhanVien
{
    public function handle($request, Closure $next)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->VaiTro !== 'nhanvien') {
        abort(403, 'Bạn không có quyền truy cập.');
    }

    return $next($request);
}

}
