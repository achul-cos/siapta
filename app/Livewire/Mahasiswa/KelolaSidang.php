<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Periode;
use App\Models\TugasAkhir;
use App\Models\Sidang;
use Illuminate\Support\Facades\Auth;

class KelolaSidang extends Component
{
    use WithFileUploads;

    public $periode_id = '';
    public $jenis_sidang = '';
    public $tugas_akhir_id = '';
    public $judul = '';
    public $dosen_pembimbing = '';
    public $dokumen = [];    

    public $periodes = [];
    public $noPeriode = false;
    public $tugas_akhirs = [];
    public $noTugasAkhir = false;

    public $mahasiswa;

    public function mount()
    {
        $this->mahasiswa = Auth::guard('mahasiswa')->user();

        // Load Periode
        $periodes = Periode::all();
        if ($periodes->isEmpty()) {
            $this->noPeriode = true;
        } else {
            $this->noPeriode = false;
            $this->periodes = $periodes->pluck('nama_periode', 'id')->toArray();
        }

        // Load Tugas Akhir milik mahasiswa
        $this->loadTugasAkhir();
    }

    public function loadTugasAkhir()
    {
        $tas = TugasAkhir::where('id_mahasiswa', $this->mahasiswa->id)
            ->with('dosen')
            ->get();

        if ($tas->isEmpty()) {
            $this->noTugasAkhir = true;
            $this->tugas_akhirs = [];
            return;
        }

        $this->noTugasAkhir = false;
        $this->tugas_akhirs = $tas->mapWithKeys(function ($ta) {
            $status = strtoupper($ta->status);
            $disabled = $ta->status !== 'proses';

            return [
                $ta->id => [
                    'judul' => $ta->judul,
                    'dosen' => $ta->dosen?->nama ?? 'Tidak Ada Dosen',
                    'status' => $status,
                    'disabled' => $disabled,
                ]
            ];
        })->toArray();
    }    

    public function updatedTugasAkhirId($value)
    {
        if ($value && isset($this->tugas_akhirs[$value])) {
            $this->judul = $this->tugas_akhirs[$value]['judul'];
            $this->dosen_pembimbing = $this->tugas_akhirs[$value]['dosen'];
        } else {
            $this->judul = '';
            $this->dosen_pembimbing = '';
        }
    }

    public function rules()
    {
        return [
            'periode_id' => 'required_if:noPeriode,false|exists:periode,id',
            'jenis_sidang' => 'required_if:noPeriode,false|in:seminar,tugas_akhir_1,tugas_akhir_2',
            'tugas_akhir_id' => [
                'required_if:noTugasAkhir,false',
                'exists:tugas_akhir,id',
                function ($attribute, $value, $fail) {
                    if ($this->noPeriode || $this->noTugasAkhir) return;

                    $sidangAktif = Sidang::where('id_tugas_akhir', $value)
                        ->where('id_periode', $this->periode_id)
                        ->where('jenis', $this->jenis_sidang)
                        ->whereIn('status', ['terjadwal', 'selesai'])
                        ->exists();

                    if ($sidangAktif) {
                        $fail('Tugas akhir ini sedang menjalani sidang ' . 
                            $this->getJenisLabel($this->jenis_sidang) . 
                            ' pada periode ini. Anda hanya dapat mendaftar ulang jika sidang sebelumnya ditolak.');
                    }
                },
            ],
            'dokumen.*' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ];
    }

    public function daftarSidang()
    {
        // 1. Cek ketersediaan periode & tugas akhir
        if ($this->noPeriode || $this->noTugasAkhir) {
            session()->flash('failed', 'Tidak dapat mendaftar: periode atau tugas akhir tidak tersedia.');
            return;
        }

        // 2. Validasi (termasuk cek sidang aktif via closure)
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Ambil pesan error pertama
            $firstError = collect($e->errors())->flatten()->first();
            session()->flash('failed', $firstError ?? 'Validasi gagal. Periksa kembali data Anda.');
            return;
        }

        $mahasiswaId = $this->mahasiswa->id;

        // Ambil id_dosen dari tugas_akhir yang dipilih
        $tugasAkhir = TugasAkhir::find($this->tugas_akhir_id);
        $idDosenPembimbing = $tugasAkhir->id_dosen; // ← ini yang akan dikirim        

        // 3. Simpan dokumen
        $dokumenPaths = [];
        foreach ($this->dokumen as $file) {
            $dokumenPaths[] = $file->store('sidang/dokumen', 'public');
        }

        // 4. Buat sidang baru
        try {
            Sidang::create([
                'id_mahasiswa'       => $mahasiswaId,
                'id_periode'         => $this->periode_id,
                'id_tugas_akhir'     => $this->tugas_akhir_id,
                'id_dosen'           => $idDosenPembimbing,
                'jenis'              => $this->jenis_sidang,
                'status'             => 'terjadwal',
                'dokumen_pendukung'  => json_encode($dokumenPaths),
                'tanggal_sidang'     => null, // ← diisi koordinator nanti
                'ruangan'            => 'Belum ditentukan',
            ]);

            // 5. SUCCESS
            session()->flash('success', 'Sidang berhasil didaftarkan! Menunggu jadwal dari koordinator.');
            
            // Reset form
            $this->reset([
                'periode_id', 'jenis_sidang', 'tugas_akhir_id',
                'judul', 'dosen_pembimbing', 'dokumen'
            ]);

        } catch (\Exception $e) {
            // 6. FAILED (database error, dll)
            session()->flash('failed', 'Gagal mendaftar sidang. Silakan coba lagi nanti.');
            \Log::error('Sidang registration failed: ' . $e->getMessage());
        }
    } 
    
    private function getJenisLabel($jenis)
    {
        return match ($jenis) {
            'seminar'         => 'Proposal',
            'tugas_akhir_1'   => 'TA 1',
            'tugas_akhir_2'   => 'TA 2',
            default           => strtoupper($jenis),
        };
    }    

    public function render()
    {
        return view('livewire.mahasiswa.kelola-sidang');
    }
}
