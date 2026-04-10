@extends('dashboard')
@section('content')
<div id="content">
    <h4>Chat với hỗ trợ</h4>

    @if($phanHoiMoi > 0)
    <div class="alert alert-info">
        Bạn có {{ $phanHoiMoi }} phản hồi mới từ cửa hàng
    </div>
    @endif

    <div id="chat-box" class="border p-3 mb-3" style="max-height: 400px; overflow-y: auto;">
        @foreach($chats as $chat)
        <div class="{{ $chat->NguoiGui == 'khach' ? 'text-end' : 'text-start' }}">
            <span class="badge bg-{{ $chat->NguoiGui == 'khach' ? 'primary' : 'secondary' }}">
                {{ $chat->NoiDung }}
            </span>
            <small class="d-block text-muted">{{ $chat->ThoiGian }}</small>
        </div>
        @endforeach
    </div>

    <form id="chat-form">
        @csrf
        <textarea name="NoiDung" class="form-control" placeholder="Nhập tin nhắn..." required></textarea>
        <button type="submit" class="btn btn-primary mt-2">Gửi</button>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chatBox = document.getElementById('chat-box');
            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            const form = document.getElementById('chat-form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                fetch("{{ route('chat.send') }}", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },

                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const newMsg = document.createElement('div');
                            newMsg.className = 'text-end';
                            newMsg.innerHTML = `
                            <span class="badge bg-primary">${data.message.NoiDung}</span>
                            <small class="d-block text-muted">${data.message.ThoiGian}</small>
                        `;
                            chatBox.appendChild(newMsg);
                            chatBox.scrollTop = chatBox.scrollHeight;
                            form.reset();
                        } else {
                            alert('Không gửi được tin nhắn');
                        }
                    })
                    .catch(err => {
                        console.log(err);
                        alert('Lỗi hệ thống khi gửi');
                    });
            });
        });
    </script>
</div>
@endsection