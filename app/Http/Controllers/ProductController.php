<?php
namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
   
    // Xóa sản phẩm
    public function destroy($id)
    {
        $product = SanPham::findOrFail($id);

        // Xóa ảnh sản phẩm nếu tồn tại
        if (File::exists(public_path('image/'.$product->Anh))) {
            File::delete(public_path('image/'.$product->Anh));
        }

        // Xóa sản phẩm khỏi database
        $product->delete();

        // Redirect về trang quản lý sản phẩm với thông báo thành công
        return redirect()->route('admin.category_product')->with('success', 'Sản phẩm đã được xóa thành công!');
    }
    public function create()
{
    return view('crud_admin.create');
}

public function store(Request $request)
{
    $request->validate([
        'TenSanPham' => 'required|string|max:255',
        'MoTa' => 'nullable|string',
        'Gia' => 'required|numeric',
        'SoLuongTon' => 'required|integer',
        'SoLuongBan' => 'nullable|integer',
        'MaDanhMuc' => 'required|integer',
        'Anh' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
    ]);

    $imageName = time() . '.' . $request->Anh->extension();
    $request->Anh->move(public_path('image'), $imageName);

    SanPham::create([
        'TenSanPham' => $request->TenSanPham,
        'MoTa' => $request->MoTa,
        'Gia' => $request->Gia,
        'SoLuongTon' => $request->SoLuongTon,
        'SoLuongBan' => $request->SoLuongBan ?? 0,
        'NgayTao' => now(),
        'MaDanhMuc' => $request->MaDanhMuc,
        'Anh' => $imageName,
    ]);

    return redirect()->route('admin.category_product')->with('success', 'Thêm sản phẩm thành công!');
}


    // Hiển thị form sửa sản phẩm
    public function edit($id)
    {
        $product = SanPham::findOrFail($id);
      
        return view('crud_admin.edit', compact('product'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $request->validate([
            'TenSanPham' => 'required|string|max:255',
            'MoTa' => 'nullable|string',
            'Gia' => 'required|numeric',
            'SoLuongTon' => 'required|integer',
            'SoLuongBan' => 'nullable|integer',
            'MaDanhMuc' => 'required|integer',
            'Anh' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $product = SanPham::findOrFail($id);

        // Kiểm tra nếu có ảnh mới
        if ($request->hasFile('Anh')) {
            // Xóa ảnh cũ nếu có
            if (File::exists(public_path('image/'.$product->Anh))) {
                File::delete(public_path('image/'.$product->Anh));
            }

            // Lưu ảnh mới
            $imageName = time() . '.' . $request->Anh->extension();
            $request->Anh->move(public_path('image'), $imageName);
            $product->Anh = $imageName;
        }

        // Cập nhật các trường khác
        $product->update([
            'TenSanPham' => $request->TenSanPham,
            'MoTa' => $request->MoTa,
            'Gia' => $request->Gia,
            'SoLuongTon' => $request->SoLuongTon,
            'SoLuongBan' => $request->SoLuongBan ?? 0,
            'NgayTao' => now(),
            'MaDanhMuc' => $request->MaDanhMuc,
        ]);

        return redirect()->route('admin.category_product')->with('success', 'Cập nhật sản phẩm thành công!');
    }
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $keyword = $request->get('keyword');
    
        // Lọc sản phẩm theo tên sản phẩm hoặc mô tả
        $products = SanPham::when($keyword, function ($query, $keyword) {
            return $query->where('TenSanPham', 'like', '%' . $keyword . '%')
                         ->orWhere('MoTa', 'like', '%' . $keyword . '%');
        })->paginate(5); // Phân trang 10 sản phẩm mỗi trang
    
        return view('crud_admin.product', compact('products'));
    }
    
    public function crud(){
        return view('crud_admin.index_nhanvien');
    }
    //Lọc sản phẩm 
    public function product(Request $request, $id = null)
{
    $query = SanPham::query();

    if ($id) {
        $query->where('MaDanhMuc', $id);
    }

    if ($request->filled('min_price')) {
        $query->where('Gia', '>=', $request->min_price);
    }

    if ($request->filled('max_price')) {
        $query->where('Gia', '<=', $request->max_price);
    }

    if ($request->filled('sort_price')) {
        if ($request->sort_price == 'asc') {
            $query->orderBy('Gia', 'asc');
        } elseif ($request->sort_price == 'desc') {
            $query->orderBy('Gia', 'desc');
        }
    }

    $sanPhams = $query->paginate(8)->appends($request->all());

    return view('product', compact('sanPhams'));
}
}
