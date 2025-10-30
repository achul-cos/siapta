<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Dosen;
use App\Models\TugasAkhir;
use Illuminate\Support\Facades\Auth;

class TugasAkhirMahasiswa extends Component
{
    use WithFileUploads;

    public $dosen_pembimbing;
    public $judul_tugas_akhir;
    public $dokumen = [];
    public $dosens;

    public function mount()
    {
        $this->dosens = Dosen::all();
    }

    private function save()
    {
        foreach ($this->dokumen as $file){
            $file->store('tugas-akhir', 'public');
        }
    }
    
    public function rules()
    {
        return [
            'dosen_pembimbing' => 'required|exists:dosen,id',
            'judul_tugas_akhir' => 'required|string',
            'dokumen.*' => 'file|max:10240',            
        ];
    }

    public function PengajuanTugasAkhir()
    {
        try {
            $this->validate();
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = collect($e->errors())->flatten()->first();
            session()->flash('failed', $firstError ?? 'Validasi gagal. Periksa kembali data Anda.');
            return;
        }

        $paths = [];
        foreach ($this->dokumen as $file) {
            $path[] = $file->store('tugas-akhir', 'public');
        }
        $this->save();

        try {
            TugasAkhir::create([
                'id_mahasiswa' => Auth::id(),
                'id_dosen' => $this->dosen_pembimbing,
                'judul' => $this->judul_tugas_akhir,
                'dokumen' => json_encode([$paths]),
            ]);

            session()->flash('success', 'Tugas Akhir berhasil diajukan!');
        } 
        catch (\Exception $e) {
            session()->flash('failed', 'Gagal Mengajukan Tugas Akhir. Silahkan Coba Lagi.');
            \Log::error('Pengajuan Tugas Akhir Gagal : '. $e->getMassage());
        }

    }

    public function render()
    {
        return view('livewire.mahasiswa.tugas-akhir-mahasiswa');
    }
}
