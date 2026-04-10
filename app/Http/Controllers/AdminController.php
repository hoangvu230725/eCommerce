<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\MaGiamGia;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{


    public function reports()
    {
        $tongDoanhThuNam = DonHang::whereYear('NgayDatHang', now()->year)->sum('TongTien');
        $tongDoanhThuThang = DonHang::whereYear('NgayDatHang', now()->year)
            ->whereMonth('NgayDatHang', now()->month)
            ->sum('TongTien');
        $tongDoanhThuNgay = DonHang::whereDate('NgayDatHang', now()->toDateString())->sum('TongTien');

        $donHangTheoTrangThai = DonHang::whereDate('NgayDatHang', now()->toDateString())
            ->select('TrangThai', DB::raw('COUNT(*) as SoLuong'))
            ->groupBy('TrangThai')
            ->get();

        return view('admin.Reports.reports', compact('tongDoanhThuNam', 'tongDoanhThuThang', 'tongDoanhThuNgay', 'donHangTheoTrangThai'));
    }


    public function getReportsByDate(Request $request)
    {
        $date = $request->query('date', now()->toDateString());

        $carbonDate = \Carbon\Carbon::parse($date);
        $year = $carbonDate->year;
        $month = $carbonDate->month;

        $tongDoanhThuNam = DonHang::whereYear('NgayDatHang', $year)->sum('TongTien');
        $tongDoanhThuThang = DonHang::whereYear('NgayDatHang', $year)
            ->whereMonth('NgayDatHang', $month)
            ->sum('TongTien');
        $tongDoanhThuNgay = DonHang::whereDate('NgayDatHang', $date)->sum('TongTien');

        $donHangTheoTrangThai = DonHang::whereDate('NgayDatHang', $date)
            ->select('TrangThai', DB::raw('COUNT(*) as SoLuong'))
            ->groupBy('TrangThai')
            ->get();

        return response()->json([
            'revenueData' => [
                (float) $tongDoanhThuNam ?? 0,
                (float) $tongDoanhThuThang ?? 0,
                (float) $tongDoanhThuNgay ?? 0
            ],
            'orderStatusData' => $donHangTheoTrangThai->map(function ($item) {
                return ['name' => $item->TrangThai, 'y' => $item->SoLuong];
            })
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $maGiamGia = MaGiamGia::where('Ma', 'LIKE', "%{$keyword}%")->get();

        $nguoiDung = NguoiDung::where('TenDangNhap', 'LIKE', "%{$keyword}%")->get();

        $hoaDon = DonHang::whereRelation('nguoiDung.khachHang', 'HoTen', 'LIKE', "%{$keyword}%")->get();

        return view('admin.searchResults', compact('maGiamGia', 'nguoiDung', 'hoaDon', 'keyword'));
    }
}
