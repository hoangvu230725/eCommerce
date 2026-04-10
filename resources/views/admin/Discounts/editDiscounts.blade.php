@extends('dashboardadmin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="{{ route('admin.discounts') }}" title="Go to Discounts" class="tip-bottom">
                <i class="icon-home"></i> Mã giảm giá
            </a>
        </div>
        <h1>Chỉnh sửa mã giảm giá</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Chỉnh sửa mã giảm giá</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="{{ route('admin.updateDiscounts') }}" method="POST" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="id" value="{{ $maGiamGia->MaGiamGia }}">
                            <div class="control-group">
                                <label class="control-label">Mã giảm giá</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="Ma" value="{{ $maGiamGia->Ma }}" placeholder="Nhập mã giảm giá" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Số tiền giảm</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="SoTienGiam" value="{{ number_format($maGiamGia->SoTienGiam, 0, ',', '.') }}" placeholder="Nhập số tiền giảm" oninput="formatCurrency(this)" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Ngày hết hạn</label>
                                <div class="controls">
                                    <input type="date" class="span11" name="NgayHetHan" value="{{ $maGiamGia->NgayHetHan }}" required />
                                </div>
                            </div>
                            <div class="form-actions">
                            <button type="submit" class="btn btn-success btn-mini" onclick="return confirm('Bạn có chắc chắn muốn sửa thông tin mã giảm giá này không?')">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection