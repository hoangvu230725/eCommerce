@extends('dashboardadmin')

@section('content')
<div id="content">
    <h4>Thêm nội dung website</h4>

    <form action="{{ route('admin.noidung.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="TieuDe" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="NoiDung" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label>Loại</label>
            <select name="Loai" class="form-select" required>
                <option value="thongbao">Thông báo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection