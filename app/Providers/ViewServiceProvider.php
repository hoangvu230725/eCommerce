<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatBox;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Chia sẻ số tin nhắn chưa đọc cho view trang chủ
        View::composer('trangchu', function ($view) {
            $soTinChuaDoc = 0;

            if (Auth::check()) {
                $soTinChuaDoc = ChatBox::where('MaNguoiDung', Auth::id())
                    ->where('NguoiGui', 'admin')
                    ->where('DaXem', false)
                    ->count();
            }

            $view->with('soTinChuaDoc', $soTinChuaDoc);
        });
    }
}
