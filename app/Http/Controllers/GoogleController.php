<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            return redirect()->route('login')->with('error', 'Có lỗi xảy ra trong quá trình đăng nhập. Vui lòng thử lại.');
        }

        // Tìm người dùng theo google_id
        $user = NguoiDung::where('google_id', $googleUser->getId())->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard');
        } else {
            // Nếu chưa có thì tạo mới
            $newUser = NguoiDung::create([
                'TenDangNhap' => $googleUser->getName(),
                'Email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'MatKhau' => bcrypt('google-user-' . $googleUser->getId()), // Gán mật khẩu mặc định
                'VaiTro' => 'khachhang', // Gán vai trò mặc định
            ]);

            Auth::login($newUser);
            return redirect()->route('dashboard');
        }
    }
}
