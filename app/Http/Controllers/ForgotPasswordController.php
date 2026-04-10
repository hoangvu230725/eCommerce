<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password'); // view bạn đã có
    }
    
    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:NguoiDung,Email',
        ]);
    
        $token = Str::random(6); // Mã 6 ký tự
    
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );
    
        Mail::raw("Mã xác nhận của bạn là: $token", function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Mã xác minh đặt lại mật khẩu');
        });
    
        session(['email_reset' => $request->email]);
    
        return redirect()->route('password.verify-form')->with('success', 'Mã xác minh đã gửi đến email của bạn.');
    }
    public function showVerifyForm()
{
    return view('auth.verify-code');
}

public function verifyCode(Request $request)
{
    $request->validate(['token' => 'required']);

    $reset = DB::table('password_resets')
        ->where('email', session('email_reset'))
        ->where('token', $request->token)
        ->first();

    if (!$reset) {
        return back()->with('error', 'Mã không đúng hoặc đã hết hạn.');
    }

    session(['verified_token' => $request->token]);

    return redirect()->route('password.reset-form');
}


public function showResetForm()
{
    return view('auth.reset-password');
}

public function resetPassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:6|confirmed',
    ]);

    $email = session('email_reset');

    DB::table('NguoiDung')
        ->where('Email', $email)
        ->update(['MatKhau' => Hash::make($request->password)]);

    DB::table('password_resets')->where('email', $email)->delete();
    session()->forget(['email_reset', 'verified_token']);

    return redirect()->route('login')->with('success', 'Mật khẩu đã được đặt lại thành công.');
}

}
