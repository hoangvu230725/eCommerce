<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GopY;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class GopYController extends Controller
{
    public function index()
    {
        $gopy = GopY::with('nguoiDung')->get();
        return view('gopy.index', compact('gopy'));
    }

    public function create()
    {
        return view('gopy.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'tieude' => 'required',
            'noidung' => 'required',
        ]);

        // Gửi email
        Mail::raw($request->noidung, function ($message) use ($request) {
            $message->to('nguyenthanhsonblbp@gmail.com')
                ->subject($request->tieude)
                ->replyTo($request->email);
        });

        // Trả về trang cảm ơn với flash message
        return redirect()->route('gopy.thankyou')
            ->with('success', 'Cảm ơn bạn đã góp ý!');
    }
    public function thankYou(){
        return view('gopy.thankyou');
    }
}