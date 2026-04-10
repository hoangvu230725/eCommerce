@extends('dashboardadmin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="#" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a>
        </div>
        <h1>Sửa thông tin người dùng</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> 
                        <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Thông tin người dùng</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <!-- BEGIN FORM -->
                        <form action="{{ route('admin.updateUser') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $nguoiDung->MaNguoiDung }}">
                            
                            <div class="control-group">
    <label class="control-label">Tên Đăng Nhập</label>
    <div class="controls">
        <input type="text" value="{{ $nguoiDung->TenDangNhap }}" class="span11" name="tendangnhap" required />
    </div>
</div>

<div class="control-group">
    <label class="control-label">Email</label>
    <div class="controls">
        <input type="email" value="{{ $nguoiDung->Email }}" class="span11" name="email" />
    </div>
</div>

<div class="control-group">
    <label class="control-label">Vai Trò</label>
    <div class="controls">
        <select name="vaitro" class="span11" required>
            <option value="nhanvien" {{ $nguoiDung->VaiTro == 'nhanvien' ? 'selected' : '' }}>Nhân viên</option>
            <option value="admin" {{ $nguoiDung->VaiTro == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="khachhang" {{ $nguoiDung->VaiTro == 'khachhang' ? 'selected' : '' }}>Khách hàng</option>
        </select>
    </div>
</div>


                            <div class="form-actions">
                                <button type="submit" class="btn btn-success btn-mini" onclick="return confirm('Bạn có chắc chắn muốn sửa thông tin người dùng này không?')">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END FORM -->
            </div>
        </div>
    </div>
</div>
@endsection
