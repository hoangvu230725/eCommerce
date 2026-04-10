<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{

    public function showInvoices()
    {
        $donHang = DonHang::where('TrangThai', 'Đã giao hàng')
            ->orderBy('MaDonHang', 'desc')
            ->paginate(10);

        return view('admin.Invoices.invoices', compact('donHang'));

    }

    public function detailInvoices(Request $request)
    {
        $donHang = DonHang::find($request->id);
        if ($donHang) {
            return view('admin.Invoices.detailInvoices', compact('donHang'));
        } else {
            return redirect()->route('admin.invoices')->with('error', 'Không tìm thấy đơn hàng.');
        }

    }

    public function deleteInvoices(Request $request) {
        $donHang = DonHang::find($request->id);
        if ($donHang) {
            $donHang->delete();
            return redirect()->route('admin.invoices')->with('success', 'Xóa đơn hàng thành công.');
        } else {
            return redirect()->route('admin.invoices')->with('error', 'Không tìm thấy đơn hàng.');
        }

    }
}
