<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembinaan extends Model
{
    protected $table = 'pembinaan';
    protected $primaryKey = 'id_pembinaan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_pembinaan',
        'nisn',
        'nip_bk',
        'tanggal',
        'catatan',
        'tindak_lanjut',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    public function guruBk()
    {
        return $this->belongsTo(Guru::class, 'nip_bk', 'nip');
    }
}
