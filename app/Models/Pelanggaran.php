<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    protected $table = 'pelanggaran';
    protected $primaryKey = 'id_pelanggaran';
    public $incrementing = false;
    protected $keyType = 'string';
    const UPDATED_AT = null;

    protected $fillable = [
        'id_pelanggaran',
        'nisn',
        'kode_pelanggaran',
        'nip_pencatat',
        'tanggal',
        'catatan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    public function jenisPelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class, 'kode_pelanggaran', 'kode_pelanggaran');
    }

    public function pencatat()
    {
        return $this->belongsTo(Guru::class, 'nip_pencatat', 'nip');
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenPelanggaran::class, 'id_pelanggaran', 'id_pelanggaran');
    }
}
