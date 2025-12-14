    @extends('templates.app')

    @section('content')
        <div class="container">
            <div class="container py-5">

                <!-- Header -->
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-primary">Dashboard Tabungan</h2>
                </div>

                <!-- Summary Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card"
                            style="background-color: #196a0b; color: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                            <div class="card-body">
                                <h5 class="card-title">Tabungan yang dimiliki</h5>
                                <h2 class="fw-bold">Rp.
                                    {{ Auth::check() ? number_format(Auth::user()->savings->sum('amount'), 0, ',', '.') : '0' }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-danger text-white shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Total Pengeluaran</h5>
                                <h2 class="fw-bold">Rp. {{ number_format($totalExpenses, 0, ',', '.') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row g-3 justify-content-center mb-5">
                    {{-- <div class="col-md-3 d-grid">
                    <button class="btn btn-primary btn-lg shadow-sm" data-bs-toggle="modal"
                        data-bs-target="#modalPemasukan">
                        + Tambah Pemasukan
                    </button>
                </div> --}}
                    <div class="col-md-3 d-grid">
                        <a class="btn btn-outline-primary btn-lg shadow-sm" href="{{ route('transactions.create') }}">
                            + Tambah Pengeluaran
                        </a>
                    </div>

                    <div class="col-md-3 d-grid">
                        <button class="btn btn-outline-primary btn-lg shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#modalTabungan">
                            + Tambah Tabungan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Pemasukan -->
            {{-- <div class="modal fade" id="modalPemasukan" tabindex="-1" aria-labelledby="modalPemasukanLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalPemasukanLabel">Tambah Pemasukan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form onsubmit="event.preventDefault()">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Jumlah (Rp)</label>
                                <input type="number" class="form-control" placeholder="Masukkan jumlah" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" placeholder="Contoh: Gaji Bulanan" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}


            <!-- Modal Tambah Tabungan -->
            <div class="modal fade" id="modalTabungan" tabindex="-1" aria-labelledby="modalTabunganLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="modalTabunganLabel">Tambah Tabungan</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('savings.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah (Rp)</label>
                                    <input type="number" name="amount" class="form-control" placeholder="Masukkan jumlah"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Target -->
            <div class="modal fade" id="modalTarget" tabindex="-1" aria-labelledby="modalTargetLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="modalTargetLabel">Tambah Target Menabung</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('targets.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Target</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Contoh: Beli Laptop" required>
                                </div>
                                {{-- upload image --}}
                                <div class="mb-3">
                                    <label class="form-label">Upload Foto</label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nominal Target (Rp)</label>
                                    <input type="number" name="amount" class="form-control"
                                        placeholder="Masukkan nominal target" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Target Menabung -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title m-0">Target Menabung</h5>
                                <a class="btn btn-success btn-sm" href ="{{ route('targets.create') }}">
                                    <i class="fas fa-plus"></i> Tambah Target
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Gambar Barang</th>
                                            <th>Nama Target</th>
                                            <th>Nominal</th>
                                            <th>Terkumpul</th>
                                            <th>Sisa</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($targets as $index => $target)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if ($target->gambar)
                                                        <img src="{{ asset('storage/' . $target->gambar) }}"
                                                            alt="{{ $target->name }}" width="50">
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $target->name }}</td>
                                                <td>Rp. {{ number_format($target->amount, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($totalSavings, 0, ',', '.') }}</td>

                                                <td>Rp.
                                                    {{ number_format(max($target->amount - $totalSavings, 0), 0, ',', '.') }}
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge {{ $totalSavings >= $target->amount ? 'bg-success' : 'bg-warning text-dark' }}">
                                                        {{ $totalSavings >= $target->amount ? 'Tercapai' : 'Belum tercapai' }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <form action="{{ route('targets.destroy', $target->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin hapus target?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-muted">Belum ada target menabung</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Transaksi -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Riwayat Transaksi</h5>
                            <div class="table-responsive">
                                <table class="table align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Jumlah</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $index => $transaction)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                                <td>{{ $transaction->note ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d F Y') }}</td>
                                                <td>
                                                    <form action="{{ route('transactions.destroy', $transaction->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-muted">Belum ada transaksi</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- chart pengeluaran --}}
            <div class="row">
                <div class="col-12">
                    <canvas id="chartLine" class="w-100"></canvas>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <footer class="text-center mt-5 mb-3 text-muted">
            <small>© 2025 Track Tabungan</small>
        </footer>
    @endsection

    @push('script')
    <script>
        let labelChart = [];
        let dataChart = [];

        $(function(){
            $.ajax({
                url: "{{ route('transactions.chart') }}",
                method: "GET",
                success: function(response){
                    labelChart = response.labels;
                    dataChart = response.data;
                    showChart();
                },
                error: function(err){
                    alert('Gagal mengambil data');
                }
            });
        });

        function showChart(){
            const ctx = document.getElementById('chartLine');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labelChart,
                    datasets: [{
                        label: '# Pengeluaran',
                        data: dataChart,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        tension: 0.3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        }
                    }
                }
            })
        }
    </script>
    @endpush
