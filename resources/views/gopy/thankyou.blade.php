@extends('dashboard')
@section('content')
<div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h4>🎉 Cảm ơn bạn đã gửi góp ý!</h4>
    <p>Chúng tôi sẽ phản hồi sớm nhất có thể.</p>

    <a href="{{ route('gopy.create') }}" class="btn btn-outline-primary">Gửi góp ý khác</a>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Về trang chủ</a>
</div>
@endsection