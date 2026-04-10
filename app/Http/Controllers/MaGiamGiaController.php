<?php

namespace App\Http\Controllers;

use App\Models\MaGiamGia;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class MaGiamGiaController extends Controller
{

    public function showDiscounts()
    {
        $discounts = MaGiamGia::orderBy('MaGiamGia', 'desc')->paginate(10); 
        return view('admin.Discounts.discounts', compact('discounts'));

    }


    public function createDiscounts()
    {
        return view('admin.Discounts.createDiscounts');

    }

    public function postDiscounts(Request $request)
    {
        $request->validate([
            'Ma' => 'required|string|max:50|unique:MaGiamGia,Ma',
            'SoTienGiam' => 'required|integer|min:0',
            'NgayHetHan' => 'required|date|after:today',
        ]);

        DB::table('MaGiamGia')->insert([
            'Ma' => $request->Ma,
            'SoTienGiam' => $request->SoTienGiam,
            'NgayHetHan' => $request->NgayHetHan,
        ]);

        return redirect()->route('admin.discounts')->with('success', 'Mã giảm giá đã được thêm thành công!');

    }
    public function editDiscounts(Request $request)
    {
        $maGiamGia = MaGiamGia::find($request->id);
        if (!$maGiamGia) {
            return redirect()->route('admin.discounts')->with('error', 'Không tìm thấy mã giảm giá.');
        }
        return view('admin.Discounts.editDiscounts', compact('maGiamGia'));

    }

    public function updateDiscounts(Request $request)
    {
        $request->validate([
            'Ma' => 'required|string|max:50|unique:MaGiamGia,Ma,'. $request->id . ',MaGiamGia',
            'SoTienGiam' => 'required|numeric|min:0',
            'NgayHetHan' => 'required|date|after:today',
        ]);

        $maGiamGia = MaGiamGia::find($request->id);
        $maGiamGia->Ma = $request->Ma;
        $maGiamGia->SoTienGiam = $request->SoTienGiam;
        $maGiamGia->NgayHetHan = $request->NgayHetHan;
        $maGiamGia->save();

        return redirect()->route('admin.discounts')->with('success', 'Mã giảm giá đã được cập nhật thành công!');

    }



    public function deleteDiscounts(Request $request)
    {
        $maGiamGia = MaGiamGia::find($request->id);
        if ($maGiamGia) {
            $maGiamGia->delete();
            return redirect()->route('admin.discounts')->with('success', 'Mã giảm giá đã được xóa thành công!');
        } else {
            return redirect()->route('admin.discounts')->with('error', 'Mã giảm giá không tồn tại!');
        }

    }
}
