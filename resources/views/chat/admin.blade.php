@extends('dashboardadmin')
@section('content')
<div id="content">
    <h4>Khách hàng cần hỗ trợ</h4>

    <ul class="list-group">
        @foreach($dsKhach as $khach)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.chat.view', $khach->MaNguoiDung) }}">
                Chat với khách {{ $khach->MaNguoiDung }}
            </a>
            @if(isset($tinChuaDoc[$khach->MaNguoiDung]) && $tinChuaDoc[$khach->MaNguoiDung] > 0)
            <span class="badge bg-danger">
                {{ $tinChuaDoc[$khach->MaNguoiDung] }} tin mới
            </span>
            @endif
        </li>
        @endforeach
    </ul>

</div>
@endsection