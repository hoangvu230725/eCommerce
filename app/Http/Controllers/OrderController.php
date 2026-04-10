<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

use App\Models\ChiTietDonHang;
use App\Models\SanPham;


class OrderController extends Controller
{
    public function index()
    {
        $orders = DonHang::with('nguoiDung.khachHang')->paginate(10); // Hiển thị 10 đơn mỗi trang
        return view('admin.orders', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = DonHang::findOrFail($id);
        $order->TrangThai = $request->TrangThai;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    public function show($id)
    {
        $order = DonHang::with(['chiTietDonHangs.sanPham'])->findOrFail($id);
        return view('admin.show', compact('order'));
    }
}
