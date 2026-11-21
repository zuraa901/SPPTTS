<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PelanggaranController extends Controller
{
    // GET /api/pelanggaran
    public function index()
    {
        $data = Pelanggaran::with(['siswa', 'jenisPelanggaran', 'pencatat'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggaran berhasil diambil',
            'data' => $data,
        ], 200);
    }

    // POST /api/pelanggaran
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'kode_pelanggaran' => 'required|exists:jenis_pelanggaran,kode_pelanggaran',
            'nip_pencatat' => 'required|exists:guru,nip',
            'tanggal' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $last = Pelanggaran::where('id_pelanggaran', 'like', 'PL-%')
            ->orderByRaw('CAST(SUBSTRING(id_pelanggaran, 4) AS UNSIGNED) DESC')
            ->first();

        $nextNumber = $last ? ((int) substr($last->id_pelanggaran, 3) + 1) : 1;
        $newId = 'PL-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $pelanggaran = Pelanggaran::create([
            'id_pelanggaran' => $newId,
            ...$validated,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggaran berhasil ditambahkan',
            'data' => $pelanggaran,
        ], 201);
    }

    // GET /api/pelanggaran/{id}
    public function show(string $id)
    {
        $pelanggaran = Pelanggaran::with(['siswa', 'jenisPelanggaran', 'pencatat', 'dokumen'])
            ->find($id);

        if (!$pelanggaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelanggaran tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data pelanggaran',
            'data' => $pelanggaran,
        ], 200);
    }

    // PUT /api/pelanggaran/{id}
    public function update(Request $request, string $id)
    {
        $pelanggaran = Pelanggaran::find($id);

        if (!$pelanggaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelanggaran tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'nisn' => 'sometimes|exists:siswa,nisn',
            'kode_pelanggaran' => 'sometimes|exists:jenis_pelanggaran,kode_pelanggaran',
            'tanggal' => 'sometimes|date',
            'catatan' => 'nullable|string',
        ]);

        $pelanggaran->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggaran berhasil diperbarui',
            'data' => $pelanggaran,
        ], 200);
    }

    // DELETE /api/pelanggaran/{id}
    public function destroy(string $id)
    {
        $pelanggaran = Pelanggaran::find($id);

        if (!$pelanggaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelanggaran tidak ditemukan',
            ], 404);
        }

        $pelanggaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggaran berhasil dihapus',
        ], 200);
    }
}