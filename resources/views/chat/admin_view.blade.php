@extends('dashboardadmin')
@section('content')
<div id="content">
    <h4>Chat với khách #{{ $id }}</h4>

    <div id="chat-container" class="border p-3 mb-3" style="max-height: 400px; overflow-y: auto;">
        @foreach($chats as $chat)
        <div class="{{ $chat->NguoiGui == 'admin' ? 'text-end' : 'text-start' }}">
            <span class="badge bg-{{ $chat->NguoiGui == 'admin' ? 'primary' : 'secondary' }}">
                {{ $chat->NoiDung }}
            </span>
            <small class="d-block text-muted">{{ $chat->ThoiGian }}</small>
        </div>
        @endforeach
    </div>

    <form id="reply-form">
        @csrf
        <input type="hidden" name="MaNguoiDung" value="{{ $id }}">
        <textarea name="NoiDung" class="form-control" placeholder="Nhập phản hồi..." required></textarea>
        <button type="submit" class="btn btn-primary mt-2">Trả lời</button>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chatContainer = document.getElementById('chat-container');
            if (chatContainer) {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }

            const form = document.getElementById('reply-form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                fetch("{{ route('admin.chat.reply') }}", {
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
                            chatContainer.appendChild(newMsg);
                            chatContainer.scrollTop = chatContainer.scrollHeight;
                            form.reset();
                        } else {
                            alert('Không gửi được tin nhắn');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Lỗi hệ thống khi gửi');
                    });
            });
        });
    </script>
</div>
@endsection