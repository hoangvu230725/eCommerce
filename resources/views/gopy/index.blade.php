@extends('dashboard')
@section('content')
<div class="container mt-4">
    <h4>Danh sách góp ý</h4>
    <a href="{{ route('gopy.create') }}" class="btn btn-success mb-3">Thêm góp ý</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">

    </table>
</div>
@endsection