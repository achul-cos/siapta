<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Koordinator;

class Login extends Component
{
    public $pengguna;     // 'mahasiswa', 'dosen', 'koordinator'
    public $login;        // NIM / NIP / NIK
    public $password;

    public function autentikasi()
    {
        // Validasi input
        $this->validate([
            'pengguna' => 'required|in:mahasiswa,dosen,koordinator',
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'pengguna.required' => 'Pilih jenis pengguna terlebih dahulu.',
            'pengguna.in' => 'Jenis pengguna tidak valid.',
            'login.required' => 'NIM/NIP/NIK wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $user = null;
        $guard = null;
        $redirect = null;

        // Tentukan model, kolom pencarian, guard, dan redirect
        switch ($this->pengguna) {
            case 'mahasiswa':
                $user = Mahasiswa::where('nim', $this->login)->first();
                $guard = 'mahasiswa';
                $redirect = '/mahasiswa/kelola-sidang';
                break;

            case 'dosen':
                $user = Dosen::where('nip', $this->login)->first();
                $guard = 'dosen';
                $redirect = '/dosen/kelola-sidang';
                break;

            case 'koordinator':
                $user = Koordinator::where('nik', $this->login)->first();
                $guard = 'koordinator';
                $redirect = '/koordinator/kelola-sidang';
                break;
        }

        // Cek user & password
        if ($user && Hash::check($this->password, $user->password)) {
            Auth::guard($guard)->login($user);
            return $this->redirect($redirect, navigate: true);
        }

        // Login gagal
        $this->addError('login', 'Login gagal! Periksa kembali identitas atau kata sandi Anda.');
    }

    public function render()
    {
        return view('livewire.login');
    }
}