@extends('templates.app')

@section('content')
<div class="container mt-5">
    <h5>Tambah User</h5>
    <form action="{{ route('staff.data-user.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="6">
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="{{ route('staff.data-user.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
