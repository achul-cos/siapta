<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nim', 'nama', 'password', 'id_mahasiswa'
    ];

    protected $hidden = ['password'];

    public function sidangs()
    {
        return $this->hasMany(Sidang::class, 'id_mahasiswa');
    }

    public function tugasAkhir()
    {
        return $this->hasOne(TugasAkhir::class, 'id_mahasiswa');
    }
}
