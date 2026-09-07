@extends('layouts.app')

@section('title', 'Dashboard Guru BK')

@section('content')
<div class="container-fluid px-4 py-4" style="background:#f4f6f9; min-height:100vh;">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0 fw-bold text-dark">Dashboard Guru BK</h3>
            <p class="text-muted mb-0">Ringkasan pelanggaran, pembinaan, dan tindak lanjut siswa {{ $namaBulan }} {{ $tahun }}</p>
        </div>
        <form method="GET" class="d-flex gap-2">
            <select name="bulan" class="form-select form-select-sm" onchange="this.form.submit()">
                @foreach(range(1,12) as $b)
                    <option value="{{ $b }}" {{ $b == $bulan ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                    </option>
                @endforeach
            </select>
            <select name="tahun" class="form-select form-select-sm" onchange="this.form.submit()">
                @foreach(range(now()->year - 1, now()->year + 1) as $t)
                    <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Kartu Statistik -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #e63946 !important;">
                <div class="card-body">
                    <div class="text-muted small mb-1">Pelanggaran Bulan Ini</div>
                    <div class="fs-3 fw-bold text-dark">{{ $totalPelanggaranBulanIni }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #f4a261 !important;">
                <div class="card-body">
                    <div class="text-muted small mb-1">Siswa Berstatus SP</div>
                    <div class="fs-3 fw-bold text-dark">{{ $totalSiswaSp }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #2a9d8f !important;">
                <div class="card-body">
                    <div class="text-muted small mb-1">Pembinaan Bulan Ini</div>
                    <div class="fs-3 fw-bold text-dark">{{ $totalPembinaanBulanIni }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #264653 !important;">
                <div class="card-body">
                    <div class="text-muted small mb-1">Surat Perjanjian Terbit</div>
                    <div class="fs-3 fw-bold text-dark">{{ $totalSpDiterbitkan }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <!-- Kolom Kiri -->
        <div class="col-lg-8">

            <!-- Rekap Kategori -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white border-0 pt-3">
                    <h6 class="fw-bold mb-0">Rekap Pelanggaran per Kategori</h6>
                </div>
                <div class="card-body">
                    @if($rekapKategori->count() > 0)
                        @foreach($rekapKategori as $kategori => $jumlah)
                            @php
                                $warna = match($kategori) {
                                    'ringan' => '#2a9d8f',
                                    'sedang' => '#f4a261',
                                    'berat' => '#e63946',
                                    default => '#6c757d',
                                };
                                $total = $rekapKategori->sum();
                                $persen = $total > 0 ? round(($jumlah / $total) * 100) : 0;
                            @endphp
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-capitalize fw-semibold">{{ $kategori }}</span>
                                    <span class="text-muted">{{ $jumlah }} kasus</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" style="width: {{ $persen }}%; background-color: {{ $warna }};"></div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted mb-0">Belum ada data pelanggaran bulan ini.</p>
                    @endif
                </div>
            </div>

            <!-- Pelanggaran Terbaru -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0">Pelanggaran Terbaru</h6>
                    <a href="{{ route('pelanggaran.index') }}" class="small text-decoration-none">Lihat semua &rarr;</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Siswa</th>
                                <th>Jenis Pelanggaran</th>
                                <th>Poin</th>
                                <th>Tanggal</th>
                                <th>Dicatat Oleh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelanggaranTerbaru as $p)
                            <tr>
                                <td class="fw-semibold">{{ $p->siswa->nama ?? '-' }}</td>
                                <td>{{ $p->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                                <td><span class="badge bg-danger-subtle text-danger-emphasis">{{ $p->jenisPelanggaran->poin ?? 0 }} poin</span></td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d M Y') }}</td>
                                <td class="text-muted small">{{ $p->pencatat->nama ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-muted py-3">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Kolom Kanan -->
        <div class="col-lg-4">

            <!-- Siswa Berstatus SP -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white border-0 pt-3">
                    <h6 class="fw-bold mb-0">Siswa Perlu Perhatian</h6>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($siswaSp as $s)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold">{{ $s->nama }}</div>
                            <div class="small text-muted">{{ $s->nisn }}</div>
                        </div>
                        <span class="badge {{ $s->status_sp == 'SP3' ? 'bg-danger' : ($s->status_sp == 'SP2' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                            {{ $s->status_sp }}
                        </span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted text-center py-3">Tidak ada siswa berstatus SP.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Pembinaan Terbaru -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3">
                    <h6 class="fw-bold mb-0">Catatan Pembinaan Terbaru</h6>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($pembinaanTerbaru as $pb)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span class="fw-semibold">{{ $pb->siswa->nama ?? '-' }}</span>
                            <span class="small text-muted">{{ \Carbon\Carbon::parse($pb->tanggal)->translatedFormat('d M') }}</span>
                        </div>
                        <div class="small text-muted mt-1">{{ Str::limit($pb->catatan, 70) }}</div>
                    </li>
                    @empty
                    <li class="list-group-item text-muted text-center py-3">Belum ada catatan pembinaan.</li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection
