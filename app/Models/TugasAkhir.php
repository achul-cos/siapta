<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TugasAkhir extends Model
{
    protected $table = 'tugas_akhir';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_mahasiswa', 'id_dosen', 'judul', 'dokumen', 'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function sidang()
    {
        return $this->hasOne(Sidang::class, 'id_tugas_akhir');
    }
}