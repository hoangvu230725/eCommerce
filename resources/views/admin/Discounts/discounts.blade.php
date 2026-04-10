@extends('dashboardadmin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <h1>Mã giảm giá</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> 
                        <span class="icon"><a href="{{ route('admin.createDiscounts') }}"> <i class="icon-plus"></i></a></span>
                        <h5>Thêm mã giảm giá</h5>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mã</th>
                                <th>Số tiền giảm</th>
                                <th>Ngày hết hạn</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($discounts as $discount)
                            <tr>
                                <td>{{ $discount->MaGiamGia }}</td>
                                <td>{{ $discount->Ma }}</td>
                                <td>{{ number_format($discount->SoTienGiam, 0, ',', '.') }} VND</td>
                                <td>{{ $discount->NgayHetHan }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.editDiscounts', ['id' => $discount->MaGiamGia]) }}" class="btn btn-success btn-mini">Sửa</a>
                                    <form action="{{ route('admin.deleteDiscounts', ['id' => $discount->MaGiamGia]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-mini" onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này không?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row" style="margin-left: 18px;">
                        <div class="page_list_clearfix text-center">
                            {{ $discounts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection