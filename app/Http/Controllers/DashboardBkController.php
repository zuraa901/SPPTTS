<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Pembinaan;
use App\Models\SuratPerjanjian;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardBkController extends Controller
{
    public function index(Request $request)
    {
        // Bulan & tahun yang sedang ditampilkan (default: bulan ini)
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);

        // ==== KARTU STATISTIK ====
        $totalPelanggaranBulanIni = Pelanggaran::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count();

        $totalSiswaSp = Siswa::where('status_sp', '!=', 'normal')->count();

        $totalPembinaanBulanIni = Pembinaan::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count();

        $totalSpDiterbitkan = SuratPerjanjian::whereMonth('tanggal_terbit', $bulan)
            ->whereYear('tanggal_terbit', $tahun)
            ->count();

        // ==== REKAP PELANGGARAN PER KATEGORI (bulan berjalan) ====
        $rekapKategori = Pelanggaran::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->join('jenis_pelanggaran', 'pelanggaran.kode_pelanggaran', '=', 'jenis_pelanggaran.kode_pelanggaran')
            ->selectRaw('jenis_pelanggaran.kategori, COUNT(*) as jumlah')
            ->groupBy('jenis_pelanggaran.kategori')
            ->pluck('jumlah', 'kategori');

        // ==== DAFTAR PELANGGARAN TERBARU ====
        $pelanggaranTerbaru = Pelanggaran::with(['siswa', 'jenisPelanggaran', 'pencatat'])
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        // ==== SISWA DENGAN STATUS SP (butuh perhatian) ====
        $siswaSp = Siswa::where('status_sp', '!=', 'normal')
            ->orderBy('total_poin_pelanggaran', 'desc')
            ->take(5)
            ->get();

        // ==== CATATAN PEMBINAAN TERBARU ====
        $pembinaanTerbaru = Pembinaan::with(['siswa'])
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        // Untuk dropdown filter bulan/tahun
        $namaBulan = Carbon::create()->month($bulan)->translatedFormat('F');

        return view('dashboard.bk', compact(
            'totalPelanggaranBulanIni',
            'totalSiswaSp',
            'totalPembinaanBulanIni',
            'totalSpDiterbitkan',
            'rekapKategori',
            'pelanggaranTerbaru',
            'siswaSp',
            'pembinaanTerbaru',
            'bulan',
            'tahun',
            'namaBulan'
        ));
    }
}
