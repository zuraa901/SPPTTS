<?php

namespace App\Services;

use App\Models\Pelanggaran;
use App\Models\Siswa;

class PoinService
{
    /**
     * Batas poin minimal tiap status (urut dari yang tertinggi).
     * Sumber: tata tertib SMKN 1 Kota Bekasi.
     *   0  - 24  : normal
     *   25 - 50  : SP1
     *   51 - 75  : SP2
     *   76 - 99  : SP3
     *   >= 100   : DO (dikembalikan ke orang tua)
     */
    public const BATAS = [
        'DO'  => 100,
        'SP3' => 76,
        'SP2' => 51,
        'SP1' => 25,
    ];

    /** Tentukan status dari total poin. */
    public static function tentukanStatus(int $poin): string
    {
        foreach (self::BATAS as $status => $batas) {
            if ($poin >= $batas) {
                return $status;
            }
        }

        return 'normal';
    }

    /**
     * Hitung ulang total poin pelanggaran seorang siswa dari tabel pelanggaran,
     * lalu simpan total dan status SP-nya ke tabel siswa.
     * Panggil setiap kali pelanggaran ditambah, diubah, atau dihapus.
     */
    public static function hitungUlang(?string $nisn): ?Siswa
    {
        if (!$nisn) {
            return null;
        }

        $siswa = Siswa::find($nisn);
        if (!$siswa) {
            return null;
        }

        $total = (int) Pelanggaran::where('pelanggaran.nisn', $nisn)
            ->join('jenis_pelanggaran', 'pelanggaran.kode_pelanggaran', '=', 'jenis_pelanggaran.kode_pelanggaran')
            ->sum('jenis_pelanggaran.poin');

        $siswa->update([
            'total_poin_pelanggaran' => $total,
            'status_sp' => self::tentukanStatus($total),
        ]);

        return $siswa;
    }
}