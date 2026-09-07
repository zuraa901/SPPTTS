<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPelanggaran extends Model
{
    protected $table = 'dokumen_pelanggaran';
    protected $primaryKey = 'id_dokumen';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_dokumen',
        'id_pelanggaran',
        'jenis_dokumen',
        'path_file',
    ];

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'id_pelanggaran', 'id_pelanggaran');
    }
}
