<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatBox;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Hiển thị khung chat cho người dùng
    public function form()
    {
        $id = Auth::id();

        // Lấy danh sách tin nhắn giữa người dùng và admin
        $chats = ChatBox::where('MaNguoiDung', $id)->orderBy('ThoiGian')->get();

        // Đếm số phản hồi chưa đọc từ admin
        $phanHoiMoi = ChatBox::where('MaNguoiDung', $id)
            ->where('NguoiGui', 'admin')
            ->where('DaXem', false)
            ->count();

        // Đánh dấu đã xem phản hồi
        ChatBox::where('MaNguoiDung', $id)
            ->where('NguoiGui', 'admin')
            ->where('DaXem', false)
            ->update(['DaXem' => true]);

        return view('chat.khach', compact('chats', 'phanHoiMoi'));
    }

    // Gửi tin từ người dùng
    public function send(Request $request)
    {
        $request->validate(['NoiDung' => 'required']);

        $message = ChatBox::create([
            'MaNguoiDung' => Auth::id(),
            'NoiDung' => $request->NoiDung,
            'NguoiGui' => 'khach',
            'ThoiGian' => now(),
            'DaXem' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    // Giao diện quản lý chat cho admin
    public function admin()
    {
        $dsKhach = ChatBox::select('MaNguoiDung')->groupBy('MaNguoiDung')->get();

        $tinChuaDoc = ChatBox::where('NguoiGui', 'khach')
            ->where('DaXem', false)
            ->selectRaw('MaNguoiDung, COUNT(*) as soLuong')
            ->groupBy('MaNguoiDung')
            ->pluck('soLuong', 'MaNguoiDung');

        return view('chat.admin', compact('dsKhach', 'tinChuaDoc'));
    }

    // Admin trả lời tin nhắn
    public function reply(Request $request)
    {
        $request->validate([
            'NoiDung' => 'required',
            'MaNguoiDung' => 'required'
        ]);

        $message = ChatBox::create([
            'MaNguoiDung' => $request->MaNguoiDung,
            'MaNhanVien' => Auth::id(),
            'NoiDung' => $request->NoiDung,
            'NguoiGui' => 'admin',
            'ThoiGian' => now(),
            'DaXem' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    // Admin xem chi tiết cuộc hội thoại
    public function viewChat($id)
    {
        ChatBox::where('MaNguoiDung', $id)
            ->where('NguoiGui', 'khach')
            ->where('DaXem', false)
            ->update(['DaXem' => true]);

        $chats = ChatBox::where('MaNguoiDung', $id)->orderBy('ThoiGian')->get();
        return view('chat.admin_view', compact('chats', 'id'));
    }

    // Tổng số tin nhắn chưa đọc (badge thông báo)
    public static function getUnreadCount()
    {
        return ChatBox::where('NguoiGui', 'khach')
            ->where('DaXem', false)
            ->count();
    }
}
