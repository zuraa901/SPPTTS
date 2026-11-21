<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\JenisPelanggaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PelanggaranController extends Controller
{
    // Menampilkan semua data pelanggaran
    public function index()
    {
        $pelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran', 'pencatat'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pelanggaran.index', compact('pelanggaran'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        $siswa = Siswa::all();
        $jenisPelanggaran = JenisPelanggaran::all();

        return view('pelanggaran.create', compact('siswa', 'jenisPelanggaran'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'kode_pelanggaran' => 'required|exists:jenis_pelanggaran,kode_pelanggaran',
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        Pelanggaran::create([
            'id_pelanggaran' => 'PL-' . strtoupper(Str::random(8)),
            'nisn' => $request->nisn,
            'kode_pelanggaran' => $request->kode_pelanggaran,
            'nip_pencatat' => auth()->user()->nip ?? 'SYSTEM',
            'tanggal' => $request->tanggal,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil ditambahkan.');
    }

    // Menampilkan detail 1 data
    public function show($id)
    {
        $pelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran', 'pencatat', 'dokumen'])
            ->findOrFail($id);

        return view('pelanggaran.show', compact('pelanggaran'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $siswa = Siswa::all();
        $jenisPelanggaran = JenisPelanggaran::all();

        return view('pelanggaran.edit', compact('pelanggaran', 'siswa', 'jenisPelanggaran'));
    }

    // Menyimpan hasil edit
    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'kode_pelanggaran' => 'required|exists:jenis_pelanggaran,kode_pelanggaran',
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $pelanggaran = Pelanggaran::findOrFail($id);
        $pelanggaran->update($request->only([
            'nisn', 'kode_pelanggaran', 'tanggal', 'catatan',
        ]));

        return redirect()->route('pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil diperbarui.');
    }

    // Menghapus data
    public function destroy($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $pelanggaran->delete();

        return redirect()->route('pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil dihapus.');
    }
}
