<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nip', 'nama', 'password'
    ];

    protected $hidden = ['password'];

    public function sidangs()
    {
        return $this->hasMany(Sidang::class, 'id_dosen');
    }
}