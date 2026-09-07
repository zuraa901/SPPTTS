<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nisn';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nisn',
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'tahun_masuk',
        'status_sp',
        'total_poin_pelanggaran',
        'total_poin_apresiasi',
    ];

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'nisn', 'nisn');
    }
}
