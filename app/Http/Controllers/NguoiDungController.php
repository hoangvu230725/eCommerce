<?php

namespace App\Http\Controllers;


use App\Models\NguoiDung;
use Illuminate\Http\Request;

class nguoiDungController extends Controller
{

    public function getAllNguoiDung()
    {
        $nguoiDung = NguoiDung::orderBy('MaNguoiDung', 'desc')->paginate(10);
        return view('admin.users.nguoidung', compact('nguoiDung'));
    }

    public function createUsers()
    {
        $nguoidung = NguoiDung::all();
        return view('admin.users.createUsers', compact('nguoidung'));
    }

    public function postUsers(Request $request)
    {
        $request->validate([
            'tendangnhap' => 'required|string|max:50|unique:NguoiDung,TenDangNhap',
            'matkhau' => 'required|string|min:6|confirmed',
            'email' => 'required|email|unique:NguoiDung,Email',
            'vaitro' => 'required|in:admin,nhanvien,khachhang',
        ]);

        NguoiDung::create([
            'TenDangNhap' => $request->tendangnhap,
            'MatKhau' => bcrypt($request->matkhau),
            'Email' => $request->email,
            'VaiTro' => $request->vaitro,
        ]);

        return redirect()->route('users.list')->with('success', 'Người dùng đã được thêm thành công!');
    }

    public function showUsers()
    {
        $nguoiDung = NguoiDung::orderBy('MaNguoiDung', 'desc')->paginate(10);
        return view('admin.Users.users', compact('nguoiDung'));
    }


    public function editUsers(Request $request)
    {
        $nguoiDung = NguoiDung::find($request->id);
        if (!$nguoiDung) {
            return redirect()->route('admin.Users.nguoidung')->with('error', 'Người dùng không tồn tại!');
        }
        $nguoidung = NguoiDung::all();
        return view('admin.Users.editUsers', compact('nguoiDung', 'nguoidung'));
    }

    public function updateUsers(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:NguoiDung,MaNguoiDung',
            'tendangnhap' => 'required|string|max:50|unique:NguoiDung,TenDangNhap,' . $request->id . ',MaNguoiDung',
            'email' => 'required|email|max:100|unique:NguoiDung,Email,' . $request->id . ',MaNguoiDung',
            'vaitro' => 'required|in:admin,nhanvien,khachhang',
        ]);

        $nguoiDung = NguoiDung::find($request->id);
        if (!$nguoiDung) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại!');
        }

        $nguoiDung->TenDangNhap = $request->tendangnhap;
        $nguoiDung->Email = $request->email;
        $nguoiDung->VaiTro = $request->vaitro;
        $nguoiDung->save();

        return redirect()->route('users.list')->with('success', 'Cập nhật thông tin người dùng thành công!');
    }


    public function deleteUsers(Request $request)
    {
        $nguoiDung = NguoiDung::find($request->id);
        if (!$nguoiDung) {
            return redirect()->route('users.list')->with('error', 'Người dùng không tồn tại!');
        }
        $nguoiDung->delete();
        return redirect()->route('users.list')->with('success', 'Xóa người dùng thành công!');
    }
}
