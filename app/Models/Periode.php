<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory;

    protected $table = 'periode';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal_mulai', 'tanggal_selesai', 'nama_periode'
    ];

    protected $dates = ['tanggal_mulai', 'tanggal_selesai'];

    public function sidangs()
    {
        return $this->hasMany(Sidang::class, 'id_periode');
    }
}