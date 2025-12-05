@extends('templates.app')

@section('content')
<div class="container mt-5">
    <h3>🧾 Tambah Pengeluaran</h3>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah Pengeluaran</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Catatan (Opsional)</label>
            <input type="text" name="note" class="form-control">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Tanggal Pengeluaran</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
