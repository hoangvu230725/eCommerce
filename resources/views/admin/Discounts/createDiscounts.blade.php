@extends('dashboardadmin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <h1>Nhân viên</h1>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Thêm mã giảm giá</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="{{ route('admin.postDiscounts') }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="control-group">
                                <label class="control-label">Mã giảm giá</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="Ma" placeholder="Nhập mã giảm giá" required />*
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Số tiền giảm</label>
                                <div class="controls">
                                    <input type="number" class="span11" name="SoTienGiam" placeholder="Nhập số tiền giảm" min="0"  required />*
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Ngày hết hạn</label>
                                <div class="controls">
                                    <input type="date" class="span11" name="NgayHetHan" required />*
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
