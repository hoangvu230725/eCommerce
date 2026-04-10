@extends('dashboardadmin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a>
        </div>
        <h1>Thêm người dùng mới</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Thông tin người dùng</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <!-- BEGIN FORM -->
                        <form action="{{ route('admin.postUsers') }}" method="POST" class="form-horizontal">
                            @csrf

                            <div class="control-group">
                                <label class="control-label">Tên đăng nhập</label>
                                <div class="controls">
                                    <input type="text" name="tendangnhap" class="span11" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Mật khẩu</label>
                                <div class="controls">
                                    <input type="password" name="matkhau" class="span11" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Nhập lại mật khẩu</label>
                                <div class="controls">
                                    <input type="password" name="matkhau_confirmation" class="span11" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input type="email" name="email" class="span11" required />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Vai trò</label>
                                <div class="controls">
                                    <select name="vaitro" class="span11" required>
                                        <option value="admin">Admin</option>
                                        <option value="nhanvien">Nhân viên</option>
                                        <option value="khachhang">Khách hàng</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Thêm</button>
                            </div>
                        </form>
                        <!-- END FORM -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
