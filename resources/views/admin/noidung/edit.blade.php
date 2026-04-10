@extends('dashboardadmin')

@section('content')
<div id="content">
    <h4>Cập nhật nội dung website</h4>

    <form action="{{ route('admin.noidung.update', ['id' => $noidung->MaNoiDung]) }}" method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="TieuDe" value="{{ $noidung->TieuDe }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="NoiDung" class="form-control" rows="3" required>{{ $noidung->NoiDung }}</textarea>
        </div>

        <div class="mb-3">
            <label>Loại</label>
            <select name="Loai" class="form-select" required>
                <option value="thongbao" {{ $noidung->Loai == 'thongbao' ? 'selected' : '' }}>Thông báo</option>
            </select>
        </div>


        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection