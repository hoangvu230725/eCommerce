<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;



use App\Models\DanhMuc;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatBox;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {



        // Chia sẻ biến $danhMucs cho tất cả view
        View::composer('*', function ($view) {
            $view->with('danhMucs', DanhMuc::all());
        });

        //

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                if ($user->VaiTro === 'admin') {
                    // Đếm số tin chưa đọc từ khách
                    $tinChuaDoc = ChatBox::where('NguoiGui', 'khach')->where('DaXem', false)->count();
                } else {
                    // Đếm số tin chưa đọc từ admin cho người dùng hiện tại
                    $tinChuaDoc = ChatBox::where('NguoiGui', 'admin')
                        ->where('MaNguoiDung', $user->MaNguoiDung)
                        ->where('DaXem', false)
                        ->count();
                }

                $view->with('soTinNhanChuaDoc', $tinChuaDoc);
            }
        });
    }
}
