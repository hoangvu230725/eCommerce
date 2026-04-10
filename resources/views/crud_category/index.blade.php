@extends('dashboard')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h2>Quản lí <b>Danh Mục</b></h2>
                    </div>
                    <div class="col-md-6 text-end">
                        <a class="btn btn-success" href="{{ route('category.create') }}">
                            <i class="bi bi-pencil"></i> <span>Thêm Danh Mục</span>
                        </a>
                    </div>
                </div>
                <!-- Form tìm kiếm -->
                <form action="{{ route('category.index') }}" method="GET" class="row g-2 mb-3">
                    <div class="col-md-4">
                        <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm..." value="{{ request('keyword') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Mã Danh Mục</th>
                        <th>Tên Danh Mục</th>
                        <th>Ngày Tạo</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->MaDanhMuc }}</td>
                        <td>{{ $category->TenDanhMuc }}</td>
                        <td>{{ $category->NgayTao->format('d/m/Y H:i') }}</td>
                        <td>
                            <!-- Edit Category -->
                            <a href="{{ route('category.edit', $category->MaDanhMuc) }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            
                            <!-- Delete Category -->
                            <form action="{{ route('category.destroy', $category->MaDanhMuc) }}" method="POST" style="display:inline;" id="delete-form-{{ $category->MaDanhMuc }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $category->MaDanhMuc }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Phân trang -->
            <div class="d-flex justify-content-center mt-4">
                {!! $categories->links('pagination::bootstrap-5') !!}
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('crud.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-left-circle me-2"></i> Quay lại
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function confirmDelete(categoryId) {
        if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
            document.getElementById('delete-form-' + categoryId).submit();
        }
    }
</script>
@endsection
@yield('scripts')