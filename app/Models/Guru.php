<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'no_hp',
    ];

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'nip_pencatat', 'nip');
    }
}
