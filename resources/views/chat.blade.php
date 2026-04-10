@extends('dashboard')

@section('content')
<div id="content">
    <h3>💬 Hỗ trợ khách hàng</h3>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Vùng hiển thị tin nhắn --}}
    <div class="border rounded p-3 mb-3" style="height: 300px; overflow-y: auto; background-color: #f9f9f9;">
        @forelse($chats as $chat)
        <div class="mb-2 text-{{ $chat->NguoiGui == 'khachhang' ? 'end' : 'start' }}">
            <strong>{{ $chat->NguoiGui == 'khachhang' ? 'Bạn' : 'admin' }}</strong>:
            <span class="d-inline-block bg-light p-2 rounded shadow-sm">
                {{ $chat->NoiDung }}
            </span>
            <br><small class="text-muted">{{ $chat->ThoiGian }}</small>
        </div>
        @empty
        <p class="text-muted">Chưa có tin nhắn nào.</p>
        @endforelse
    </div>

    {{-- Form gửi tin nhắn --}}
    <form action="{{ route('chat.send') }}" method="POST">
        @csrf
        <input type="hidden" name="MaNguoiDung" value="{{ auth()->user()->MaNguoiDung ?? 1 }}">
        {{-- sửa lại nếu dùng session --}}

        <div class="mb-3">
            <textarea name="NoiDung" class="form-control" rows="3" placeholder="Nhập nội dung cần hỗ trợ..."
                required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
</div>
@endsection