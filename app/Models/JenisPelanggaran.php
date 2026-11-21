<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPelanggaran extends Model
{
    protected $table = 'jenis_pelanggaran';
    protected $primaryKey = 'kode_pelanggaran';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode_pelanggaran',
        'nama_pelanggaran',
        'poin',
        'kategori',
    ];

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'kode_pelanggaran', 'kode_pelanggaran');
    }
}
