<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sidang extends Model
{
    protected $table = 'sidang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_mahasiswa', 'id_dosen', 'id_periode', 'jenis', 'status',
        'ruangan', 'tanggal_sidang', 'id_tugas_akhir', 'dokumen_pendukung'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }

    public function tugasAkhir()
    {
        return $this->belongsTo(TugasAkhir::class, 'id_tugas_akhir');
    }
}
