<?php
namespace App\Http\Controllers;

use App\Models\DanhMuc;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục và tìm kiếm
    public function index(Request $request)
    {
        $keyword = $request->input('keyword'); // Lấy từ khóa tìm kiếm từ yêu cầu

        // Lọc danh mục theo tên hoặc mã danh mục
        $categories = DanhMuc::where('TenDanhMuc', 'like', '%' . $keyword . '%')
                             ->orWhere('MaDanhMuc', 'like', '%' . $keyword . '%')
                             ->paginate(5);

        return view('crud_category.index', compact('categories'));
    }
    public function edit($id)
    {
        $category = DanhMuc::findOrFail($id);
        return view('crud_category.edit', compact('category'));
    }

    // Cập nhật danh mục
    public function update(Request $request, $id)
    {
        $request->validate([
            'TenDanhMuc' => 'required|string|max:255',
            'MoTa' => 'nullable|string',
        ]);

        $category = DanhMuc::findOrFail($id);
        $category->TenDanhMuc = $request->TenDanhMuc;
        $category->MoTa = $request->MoTa;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    // Xóa danh mục
    public function destroy($id)
    {
        $category = DanhMuc::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công!');
    }
// Hiển thị form thêm mới
public function create()
{
    return view('crud_category.create');
}

// Lưu danh mục mới vào database
public function store(Request $request)
{
    $request->validate([
        'TenDanhMuc' => 'required|string|max:255',
        'MoTa' => 'nullable|string',
    ]);

    DanhMuc::create([
        'TenDanhMuc' => $request->TenDanhMuc,
        'MoTa' => $request->MoTa,
        'NgayTao' => now(),
    ]);

    return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công!');
}

}
