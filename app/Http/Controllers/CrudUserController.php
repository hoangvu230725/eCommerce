<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;

use App\Models\SanPham;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\NoiDungWebsite;




class CrudUserController extends Controller
{

    public function login()
    {
        return view('crud_user.login');
    }

   public function authUser(Request $request)
{
    $request->validate([
        'Email' => 'required|email',
        'MatKhau' => 'required|min:6',
    ]);

    if (Auth::attempt([
        'Email' => $request->Email,
        'password' => $request->MatKhau
    ])) {
        $user = Auth::user();

        switch ($user->VaiTro) {
            case 'nhanvien':
                return redirect()->route('crud.index');
            case 'admin':
                return redirect()->route('admin.orders');
              case 'khachhang':
                return redirect()->route('dashboard');
            default:
                Auth::logout();
                return back()->withErrors(['Email' => 'Bạn không có quyền truy cập.']);
        }
    }

    return back()->withErrors(['MatKhau' => 'Email hoặc mật khẩu không đúng.']);
}

    public function createUser()
    {
        return view('crud_user.create');
    }

    public function postUser(Request $request)
    {
        $request->validate([


            'TenDangNhap' => 'required',
            'Email' => 'required|email|max:50|unique:NguoiDung,Email',
            'MatKhau' => 'required|min:6|max:50',
        ], [
            'TenDangNhap.required' => 'Tên đăng nhập không được để trống.',
            'Email.required' => 'Email không được để trống.',
            'Email.email' => 'Email không hợp lệ.',
            'Email.unique' => 'Email đã được đăng ký.',
            'MatKhau.required' => 'Mật khẩu không được để trống.',
            'MatKhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'MatKhau.max' => 'Mật khẩu tối đa 50 kí tự.',

        ]);

        NguoiDung::create([
            'TenDangNhap' => $request->TenDangNhap,
            'Email' => $request->Email,
            'MatKhau' => Hash::make($request->MatKhau),
            'VaiTro' => 'khachhang'
        ]);

        return redirect("login")->with('success', 'Tạo tài khoản thành công!');
    }

    public function listUser()
    {
        if (Auth::check()) {
            $users = NguoiDung::all();
            return view('crud_user.list', ['users' => $users]);
        }

        return redirect("login")->with('error', 'Bạn chưa đăng nhập.');
    }

    public function readUser(Request $request)
    {
        $user = NguoiDung::find($request->id);
        return view('crud_user.read', ['messi' => $user]);
    }

    public function deleteUser(Request $request)
    {
        NguoiDung::destroy($request->id);
        return redirect("list")->with('success', 'Người dùng đã bị xóa.');
    }

    public function updateUser(Request $request)
    {
        $user = NguoiDung::find($request->id);
        return view('crud_user.update', ['user' => $user]);
    }

    public function postUpdateUser(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required',
            'Email' => 'required|email|unique:NguoiDung,Email,' . $request->id . ',MaNguoiDung',
            'MatKhau' => 'required|min:6',
        ]);

        $user = NguoiDung::find($request->id);
        $user->TenDangNhap = $request->TenDangNhap;
        $user->Email = $request->Email;
        $user->MatKhau = Hash::make($request->MatKhau);
        $user->save();

        return redirect("list")->with('success', 'Cập nhật thành công.');
    }

    public function signOut()
    {
        Auth::logout();
        Session::flush();
        return redirect('login')->with('message', 'Đăng xuất thành công.');
    }

    public function dashboard()
    {

        $sanPhamMoi = SanPham::orderBy('NgayTao', 'desc')->take(5)->get();
        $products = SanPham::all();
        $banners = NoiDungWebsite::where('Loai', 'banner')->latest()->take(3)->get();
        $thongbaos = NoiDungWebsite::where('Loai', 'thongbao')->where('TrangThai', true)->take(1)->get();
    
        return view('trangchu', compact('sanPhamMoi', 'products', 'banners', 'thongbaos'));
    }
    



    public function forgetpw()
    {
        return view('crud_user.forgetpw');
    }



    public function thongTinCaNhan()
    {
        $nguoiDung = Auth::user();
        return view('crud_user.info', compact('nguoiDung'));
    }

    public function formDoiMatKhau()
    {
        return view('crud_user.change_password');
    }

    public function doiMatKhau(Request $request)
    {
        $request->validate([
            'MatKhauCu' => 'required|max:50',
            'MatKhauMoi' => 'required|min:6|max:50|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->MatKhauCu, $user->MatKhau)) {
            return back()->withErrors(['MatKhauCu' => 'Mật khẩu cũ không đúng.']);
        }

        $user->MatKhau = Hash::make($request->MatKhauMoi);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $sanPhams = SanPham::where('TenSanPham', 'like', '%' . $query . '%')->paginate(12);
        return view('product', compact('sanPhams'));
    }

    public function showProductDetail($id)
    {
        $sanpham = SanPham::findOrFail($id);
    
       
        $goiY = SanPham::where('MaDanhMuc', $sanpham->MaDanhMuc)
                      ->where('MaSanPham', '!=', $id)
                      ->take(4)
                      ->get();
    
        return view('product_detail', compact('sanpham', 'goiY'));
    }
    
}


