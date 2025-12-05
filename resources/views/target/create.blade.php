@extends('templates.app')

@section('content')
<div class="container py-5">
    <h3>Tambah Target Menabung</h3>
    <form action="{{ route('targets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Target</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Upload Foto</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label class="form-label">Nominal Target (Rp)</label>
            <input type="number" name="amount" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
