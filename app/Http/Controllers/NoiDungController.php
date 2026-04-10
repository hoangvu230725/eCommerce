<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoiDungWebsite;

class NoiDungController extends Controller
{
    public function index()
    {
        $noidungs = NoiDungWebsite::latest()->paginate(10);;
        return view('admin.noidung.index', compact('noidungs'));
    }

    public function create()
    {
        return view('admin.noidung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TieuDe' => 'required',
            'NoiDung' => 'required',
            'Loai' => 'required|in:banner,thongbao',
        ]);

        NoiDungWebsite::create([
            'TieuDe' => $request->TieuDe,
            'NoiDung' => $request->NoiDung,
            'Loai' => $request->Loai,
            'TrangThai' => $request->Loai === 'thongbao' ? true : false,
        ]);
        return redirect()->route('admin.noidung.index')->with('success', 'Thêm nội dung thành công');
    }

    public function destroy($id)
    {
        $noidung = NoiDungWebsite::find($id);

        if (!$noidung) {
            return redirect()->route('admin.noidung.index')->with('error', 'Thông báo này đã bị xóa. Vui lòng tải lại trang.');
        }

        $noidung->delete();
        return redirect()->route('admin.noidung.index')->with('success', 'Xóa thông báo thành công.');
    }


    public function activate($id)
    {
        // Ẩn tất cả thông báo hiện tại
        NoiDungWebsite::where('Loai', 'thongbao')->update(['TrangThai' => false]);

        // Bật cái được chọn
        $thongbao = NoiDungWebsite::findOrFail($id);
        $thongbao->TrangThai = true;
        $thongbao->save();

        return redirect()->back()->with('success', 'Đã chọn thông báo này để hiển thị!');
    }

    public function edit($id)
    {
        $noidung = NoiDungWebsite::findOrFail($id);
        return view('admin.noidung.edit', compact('noidung'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TieuDe' => 'required',
            'NoiDung' => 'required',
            'Loai'    => 'required',
        ]);

        $noidung = NoiDungWebsite::findOrFail($id);
        $noidung->TieuDe = $request->TieuDe;
        $noidung->NoiDung = $request->NoiDung;
        $noidung->Loai = $request->Loai;
        $noidung->TrangThai = $request->TrangThai ?? $noidung->TrangThai;

        $noidung->save();

        return redirect()->route('admin.noidung.index')->with('success', 'Cập nhật thành công');
    }
}
