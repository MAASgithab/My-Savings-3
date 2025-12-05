@extends('templates.app')

@section('content')
<div class="container">
    <h5>Edit Staff</h5>
    <form action="{{ route('admin.data-staff.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
            <input type="password" class="form-control" id="password" name="password" minlength="6">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.data-staff.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
