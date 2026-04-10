@extends('dashboardadmin')

@section('content')
<div id="content">
    <h4>Danh sách nội dung website</h4>
    <a href="{{ route('admin.noidung.create') }}" class="btn btn-success mb-2">Thêm mới</a>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Loại</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($noidungs as $item)
            <tr>
                <td>{{ $item->TieuDe }}</td>
                <td>{{ $item->NoiDung }}</td>
                <td>{{ ucfirst($item->Loai) }}</td>
                <td>
                    @if($item->Loai === 'thongbao')
                    {!! $item->TrangThai ? '<span class="text-success">Đang hiển thị</span>' : '<span
                        class="text-muted">Ẩn</span>' !!}
                    @endif
                </td>
                <td>
                    @if($item->Loai === 'thongbao' && !$item->TrangThai)
                    <form action="{{ route('admin.noidung.activate', $item->MaNoiDung) }}" method="POST"
                        class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-warning">Hiển thị</button>
                    </form>
                    @endif
                    <a href="{{ route('admin.noidung.edit', $item->MaNoiDung) }}" class="btn btn-sm btn-primary">Sửa</a>
                    <form action="{{ route('admin.noidung.destroy', $item->MaNoiDung) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row" style="margin-left: 18px;">
        <div class="page_list_clearfix  text-center">
            {{ $noidungs->links() }}
        </div>
    </div>
</div>
@endsection