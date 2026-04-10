<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\GioHang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $manguoidung = auth()->id();
        $masanpham = $request->masanpham;
        $item = GioHang::where('MaNguoiDung' , $manguoidung)->where('MaSanPham' , $request->masanpham)->first();
        $tenSanPham = SanPham::where('MaSanPham', $masanpham)->value('TenSanPham');
        if($item){
            $item->SoLuong += $request->so_luong ?? 1;
            $item->save();
        }else{
            GioHang::create([
                'MaNguoiDung' => $manguoidung,
                'MaSanPham' => $masanpham,
                'SoLuong' => $request->so_luong ?? 1,
                'TenSanPham' => $tenSanPham,
                'created_at' => now(),
                'updated_at' =>now(),
            ]);
        }
        return redirect()->route('cart.cart')->with('success','Thêm Sản Phẩm Thành Công!');
            
    }

    public function cart(){
       
        $userID = Auth()->id();
        $cartItems = DB::table('GioHang')
        ->join('sanpham', 'giohang.MaSanPham', '=', 'sanpham.MaSanPham')
        ->where('giohang.MaNguoiDung', $userID)
        
        ->select('giohang.*', 'sanpham.TenSanPham', 'sanpham.Gia', 'sanpham.Anh') 
        ->get();

      
        return view('cart.cart', compact('cartItems'));
    }


    //cart remove
    public function remove($masanpham){
        $manguoidung = Auth()->id();
        GioHang::where('MaNguoiDung' , $manguoidung)->where('MaSanPham', $masanpham)->delete();
        return redirect()->back()->with('Success', 'Xóa Sản Phẩm Thành Công!');
    }

    //cart update
    public function updateQuantity(Request $request, $MaGioHang){
        $request->validate([
            'quantity' =>'required|integer|min:1',
        ]);
        $item = DB::table('giohang')->where('MaGioHang' ,$MaGioHang)->first();
        if($item){
            DB::table('giohang')->where('MaGioHang',$MaGioHang)->update(['SoLuong'=>$request->quantity]);
           return redirect()->back()->with('success', 'Cập Nhật Số Lượng Thành Công!');
        }else{
            return redirect()->back()->with('error', 'Cập Nhật Số Lượng Thất Bại!');
        }
    }
    public function showCart(){
        $maNguoiDung  = Auth()->id();
        $cartItems =DB::table('giohang')
        ->join('sanpham', 'giohang.MaSanPham', '=', 'sanpham.MaSanPham')
        ->where('giohang.MaNguoiDung', $maNguoiDung)
        ->select('giohang.*', 'sanpham.gia', 'sanpham.Anh')
        ->get();
        return view('cart.cart', compact('cartItems'));

    }
    public function getCoupons(){
        $coupons = DB::table('magiamgia')->get(); 
    return response()->json($coupons); 
    }
    //cart payment
    public function submitPayment(Request $request){
        // Validate dữ liệu từ form
        $request->validate([
            'hoten' => 'required',
            'sodienthoai' => 'required',
            'diachi' => 'required',
            'paymentMethod' => 'required|string',
            'ghichu' => 'nullable|string',
        ]);
    
        $appliedCoupon = session('applied_coupon');
        $manguoidung = auth()->id();
    
        $cartItems = DB::table('giohang')
            ->join('sanpham', 'giohang.MaSanPham', '=', 'sanpham.MaSanPham')
            ->where('giohang.MaNguoiDung', $manguoidung)
            ->select('giohang.*', 'sanpham.TenSanPham', 'sanpham.Gia')
            ->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $total_after = 0;
        $discount = 0;
        $discountedItems = [];

        if($appliedCoupon){
            $coupon = DB::table('magiamgia')->where('MaGiamGia', $appliedCoupon)->first();
            if($coupon){
                $discount = $coupon->SoTienGiam;
            }
        }

        foreach ($cartItems as $item) {
            $itemTotal = $item->Gia * $item->SoLuong;
            $total_after += $itemTotal;
            if($discount > 0) {
                $discountPerItem = $discount / count($cartItems);
                $discountedPrice = $item->Gia - ($discountPerItem / $item->SoLuong);
                $discountedItems[] = [
                    'MaSanPham' => $item->MaSanPham,
                    'SoLuong' => $item->SoLuong,
                    'Gia' => $discountedPrice
                ];
            } else {
                $discountedItems[] = [
                    'MaSanPham' => $item->MaSanPham,
                    'SoLuong' => $item->SoLuong,
                    'Gia' => $item->Gia
                ];
            }
        }

        if($discount > 0) {
            $total_after -= $discount;
        }
    
        $paymentMethod = $request->input('paymentMethod');
        $paymentData = [
            'NgayThanhToan' => now(),
            'SoTien' => $total_after,
            'PhuongThuc' => $paymentMethod,
            'ghichu'=> $request->ghichu,
        ];


        if($paymentMethod === 'cod'){
            $maDonHang = DB::table('donhang')->insertGetId([
                'MaNguoiDung' => $manguoidung,
                'NgayDatHang' => now(),
                'TongTien' => $total_after,
                'TrangThai' => 'Chờ xác nhận',
                'MaGiamGia' => $appliedCoupon, 
            ]);
            if ($appliedCoupon) {
                session()->forget('applied_coupon');
            }
            foreach ($discountedItems as $item) {
                DB::table('chitietdonhang')->insert([
                    'MaDonHang' => $maDonHang,
                    'MaSanPham' => $item['MaSanPham'],
                    'SoLuong' => $item['SoLuong'],
                    'Gia' => $item['Gia'],
                ]);
            }
            $paymentData['MaDonHang'] = $maDonHang;
            DB::table('thanhtoan')->insert($paymentData);
            DB::table('giohang')->where('MaNguoiDung', $manguoidung)->delete();
            return view('cart.result_cart', ['maDonHang' => $maDonHang]);
        }

        if ($paymentMethod === 'momo') {
            session([
                'pending_order' => [
                    'manguoidung' => $manguoidung,
                    'appliedCoupon' => $appliedCoupon,
                    'discountedItems' => $discountedItems,
                    'total_after' => $total_after,
                    'paymentData' => $paymentData,
                ]
            ]);
  
            DB::table('giohang')->where('MaNguoiDung', $manguoidung)->delete();
            return view('cart.momo_check', compact('total_after'));
        }
        
        Session::put('payment_completed', true);
        return redirect()->route('cart.result_cart')->with('success', 'Thanh toán thành công!');
    }
               
    public function showCoupons()
    {
        // Lấy danh sách mã giảm giá còn hiệu lực
        $coupons = DB::table('magiamgia')
            ->whereDate('NgayHetHan', '>=', now()) 
            ->get(['MaGiamGia', 'Ma', 'SoTienGiam', 'NgayHetHan']); 
        
        return view('cart.getCoupons', compact('coupons'));
    }

    public function applyCoupon($coupon_code)
    {
   
        $coupon = DB::table('magiamgia')
            ->where('MaGiamGia', $coupon_code)
            ->whereDate('NgayHetHan', '>=', now()) 
            ->first();
    
        if (!$coupon) {
            return redirect()->route('cart.getCoupons')->with('error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
        }
    
    
        session(['applied_coupon' => $coupon_code, 'payment_method_error' => true]);
    
   
        return redirect()->route('cart.cartpayment');
    }
    
    //info user
    public function infoUser(){
        return view('cart.info_user');
    }
    public function storeInfo(Request $request){
        $request -> validate([
            'hoten'=> 'required|string|max:255',
            'sdt' => 'required|regex:/^[0-9]{10,11}$/',
            'province'=> 'required|string',
            'district'=> 'required|string',
            'ward' =>'required|string',
        ] ,[
            'sdt.regex' => 'Số Điện Thoại Không Hợp Lệ.',
            'province.required' => 'Tỉnh Không Được Để Trống.',
             'district.required' => 'Huyện Không Được Để Trống.',
             'ward.required' => 'Xã Không Được Để Trống.',
        ]);
        
        $tinh = json_decode(file_get_contents(public_path('data/tinh_tp.json')), true);
        $quan = json_decode(file_get_contents(public_path('data/quan_huyen.json')), true);
        $xa = json_decode(file_get_contents(public_path('data/xa_phuong.json')), true);


        //lay ten tinh
        $province = collect($tinh)->firstWhere('code',$request->province)['name_with_type']?? '';
        $district = collect($quan)->firstWhere('code',$request->district)['name_with_type']?? '';
        $ward = collect($xa)->firstWhere('code',$request->ward)['name_with_type']?? '';

        $fullDiachi = "{$ward},{$district},{$province}";
        $userID = Auth()->id();
        $khachhang = DB::table('khachhang')->where('MaNguoiDung', $userID)->first();
        if(!$khachhang){
            DB::table('khachhang')->insert([
                'MaNguoiDung'=> $userID ,
                'HoTen' => $request->hoten,
                'SoDienThoai' =>$request->sdt,
                'DiaChi' => $fullDiachi,

            ]);
        }else{
            DB::table('khachhang')->where('MaNguoiDung',$userID)->update([
                'HoTen' => $request->hoten,
                'SoDienThoai' =>$request->sdt,
                'DiaChi' => $fullDiachi,
            ]);
        }
        session([
            'info_checkout'=>[
                'HoTen' => $request->hoten ?? '',
                'SoDienThoai' => $request->sdt ?? '',
                'DiaChi' =>$fullDiachi ?? '',
            ],
            'payment_method_error' => true 
        ]);
        return redirect()->route('cart.cartpayment');

    }
    //kiem tra gio hang khi nguoi dung nhan mua hang
    public function checkCart(){
        $userID = Auth()->id();
        $khachhang = DB::table('khachhang')->where('MaNguoiDung', $userID)->first();
        if($khachhang){
            // dua toi form thanh toan
            return redirect()->route('cart.cartpayment');
        }else{
            return redirect()->route('cart.info_user');
        }
    }
    public function CartPayment() {
        if (!session()->has('info_checkout')) {
            return redirect()->route('cart.info_user')->with('error', 'Vui lòng cập nhật thông tin trước khi thanh toán');
        }

        Session::put('checkout_in_progress', true);

        $cartItems = DB::table('giohang')
            ->join('sanpham', 'giohang.MaSanPham', '=', 'sanpham.MaSanPham')
            ->where('giohang.MaNguoiDung', auth()->id())
            ->select('giohang.*', 'sanpham.Gia')
            ->get();

        if ($cartItems->isEmpty()) {
            Session::forget('checkout_in_progress');
            return redirect()->route('cart.cart')->with('error', 'Giỏ hàng của bạn đang trống');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->Gia * $item->SoLuong;
        }

        $discount = 0;
        $appliedCoupon = session('applied_coupon');
        if ($appliedCoupon) {
            $coupon = DB::table('magiamgia')->where('MaGiamGia', $appliedCoupon)->first();
            if ($coupon) {
                $discount = $coupon->SoTienGiam;
            }
        }

        // Đảm bảo tổng tiền không âm
        $total_after = max($total - $discount, 0);

        
        $showPaymentMethodError = session('payment_method_error');
        session()->forget('payment_method_error');
        return view('cart.cart_payment', compact('total_after', 'appliedCoupon', 'discount', 'total'))
            ->with('payment_method_error', $showPaymentMethodError ? 'Vui Lòng Chọn Phương Thức Thanh Toán' : null);
    }

    //momo check
    
    //tra ve trang ket qua thanh toan
    public function CartResult(){
     
        Session::forget('checkout_in_progress');
        
        if (session()->has('pending_order')) {
            $pending = session('pending_order');
            $manguoidung = $pending['manguoidung'];
            $appliedCoupon = $pending['appliedCoupon'];
            $discountedItems = $pending['discountedItems'];
            $total_after = $pending['total_after'];
            $paymentData = $pending['paymentData'];
            // Lưu đơn hàng
            $maDonHang = DB::table('donhang')->insertGetId([
                'MaNguoiDung' => $manguoidung,
                'NgayDatHang' => now(),
                'TongTien' => $total_after,
                'TrangThai' => 'Chờ xác nhận',
                'MaGiamGia' => $appliedCoupon, 
            ]);
            if ($appliedCoupon) {
                session()->forget('applied_coupon');
            }
            foreach ($discountedItems as $item) {
                DB::table('chitietdonhang')->insert([
                    'MaDonHang' => $maDonHang,
                    'MaSanPham' => $item['MaSanPham'],
                    'SoLuong' => $item['SoLuong'],
                    'Gia' => $item['Gia'],
                ]);
            }
            $paymentData['MaDonHang'] = $maDonHang;
            DB::table('thanhtoan')->insert($paymentData);
            // Xóa session pending_order
            session()->forget('pending_order');
            return view('cart.result_cart', ['maDonHang' => $maDonHang]);
        }
        return view('cart.result_cart');
    }
    //chi tiet don hang
    public function order_detail($MaDonHang){

        $order = DB::table('donhang')->where('MaDonHang', $MaDonHang)->first();
    $orderDetails = DB::table('chitietdonhang')
        ->join('sanpham', 'chitietdonhang.MaSanPham', '=', 'sanpham.MaSanPham')
        ->where('chitietdonhang.MaDonHang', $MaDonHang)
        ->select('chitietdonhang.*', 'sanpham.TenSanPham', 'sanpham.Anh', 'sanpham.Gia', 'sanpham.MoTa' , 'sanpham.TenSanPham')
        ->get();
    $selectedDate = \Carbon\Carbon::parse($order->NgayDatHang)->format('Y-m-d');

    return view('cart.order_detail', compact('order', 'orderDetails', 'selectedDate'));
    }
    public function historyCart(Request $request){
        $selectedDate = $request->input('date');

        if(!$selectedDate){
            $orders = DB::table('donhang')->where('MaNguoiDung', auth()->id())
            ->orderBy('NgayDatHang', 'desc')->paginate(10);
        }else{
            $orders = DB::table('donhang')
            ->where('MaNguoiDung', auth()->id())
            ->whereDate('NgayDatHang', $selectedDate)
            ->orderBy('NgayDatHang', 'desc')
            ->paginate(10);
        }
        return view('cart.history_cart', compact('orders', 'selectedDate'));
    }

}
