<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Koordinator extends Authenticatable
{
    use Notifiable;

    protected $table = 'koordinator';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nik', 'nama', 'password'
    ];

    protected $hidden = ['password'];
}