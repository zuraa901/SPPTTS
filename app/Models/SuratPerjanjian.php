<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratPerjanjian extends Model
{
    protected $table = 'surat_perjanjian';
    protected $primaryKey = 'id_sp';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_sp',
        'nisn',
        'jenis_sp',
        'tanggal_terbit',
        'nip_pembuat',
        'path_file',
        'keterangan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    public function pembuat()
    {
        return $this->belongsTo(Guru::class, 'nip_pembuat', 'nip');
    }
}
