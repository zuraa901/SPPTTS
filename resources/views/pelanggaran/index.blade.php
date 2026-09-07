@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Data Pelanggaran Siswa</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pelanggaran.create') }}" class="btn btn-primary mb-3">+ Tambah Pelanggaran</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Jenis Pelanggaran</th>
                <th>Poin</th>
                <th>Tanggal</th>
                <th>Dicatat Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelanggaran as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->siswa->nama ?? '-' }}</td>
                <td>{{ $item->jenisPelanggaran->nama_pelanggaran ?? '-' }}</td>
                <td>{{ $item->jenisPelanggaran->poin ?? '-' }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->pencatat->nama ?? '-' }}</td>
                <td>
                    <a href="{{ route('pelanggaran.show', $item->id_pelanggaran) }}" class="btn btn-sm btn-info">Lihat</a>
                    <a href="{{ route('pelanggaran.edit', $item->id_pelanggaran) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('pelanggaran.destroy', $item->id_pelanggaran) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada data pelanggaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
