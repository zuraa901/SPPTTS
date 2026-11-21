@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Data Pelanggaran</h2>

    <form action="{{ route('pelanggaran.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Siswa</label>
            <select name="nisn" class="form-control" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach($siswa as $s)
                    <option value="{{ $s->nisn }}">{{ $s->nama }} ({{ $s->nisn }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Pelanggaran</label>
            <select name="kode_pelanggaran" class="form-control" required>
                <option value="">-- Pilih Jenis Pelanggaran --</option>
                @foreach($jenisPelanggaran as $jp)
                    <option value="{{ $jp->kode_pelanggaran }}">{{ $jp->nama_pelanggaran }} ({{ $jp->poin }} poin)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Kejadian</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan</label>
            <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pelanggaran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
