@extends('dashboardadmin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <h1>người dùng</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                   
                    <div class="widget-title"> <span class="icon"><a href="{{ route('admin.createUsers') }}"> <i class="icon-plus"></i>
                            </a></span>
                        <h5>Thêm người dùng</h5>
                    </div>
                    <table class="table table-bordered">

                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Tên đăng nhập</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Ngày tạo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($nguoiDung as $nguoiDungs)
                            <tr>
                                <td>{{$nguoiDungs->MaNguoiDung}}</td>
                                <td>{{$nguoiDungs->TenDangNhap}}</td>
                                <td>{{$nguoiDungs->Email}}</td>
                                <td>{{$nguoiDungs->VaiTro}}</td>
                                <td>{{$nguoiDungs->NgayTao}}</td>

                                <td class="text-center">
                                  
                                   <a href="{{ route('admin.edit', ['id' => $nguoiDungs->MaNguoiDung]) }}" class="btn btn-success btn-mini">Sửa</a>

                                  
                                    <form action="{{ route('admin.deleteUser', ['id' => $nguoiDungs->MaNguoiDung]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-mini" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row" style="margin-left: 18px;">
                        <div class="page_list_clearfix  text-center">
                            {{ $nguoiDung->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection