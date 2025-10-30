<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Koordinator;
use App\Models\Periode;
use App\Models\TugasAkhir;
use App\Models\Sidang;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Koordinator (opsional)
        Koordinator::create([
            'nik' => 'NIK123456789',
            'nama' => 'Dr. Koordinator',
            'password' => Hash::make('password'),
        ]);

        // 2. Buat 5 Dosen
        $dosens = Dosen::factory(5)->create();

        // Tambahkan 1 akun dosen khusus (Cyntia)
        $dosenKhusus = Dosen::factory()->create([
            'nama' => 'Cyntia Lasmi Andesti, S.Kom, M.Kom',
            'password' => \Illuminate\Support\Facades\Hash::make('dosen1234'),
            'nip' => 'NIP1234567890',
        ]);

        // Masukkan dosen khusus ke collection $dosens supaya bisa dipakai acak nanti
        $dosens->push($dosenKhusus);

        // 3. Buat Periode (1 periode untuk semua sidang)
        $periode = Periode::create([
            'tanggal_mulai' => '2025-10-01',
            'tanggal_selesai' => '2025-10-31',
            'nama_periode' => 'Oktober 2025',
        ]);

        // 4. Buat 5 Mahasiswa + 1 Akun Khusus
        $mahasiswas = Mahasiswa::factory(5)->create();

        // Akun khusus untuk testing login
        $mahasiswaKhusus = Mahasiswa::create([
            'nim' => 'MHS0001',
            'nama' => 'Nasrullah',
            'password' => Hash::make('123456'),
        ]);

        $mahasiswas->push($mahasiswaKhusus);

        // 5. Untuk setiap mahasiswa: buat Tugas Akhir + 1 Sidang
        $jenisSidang = ['seminar', 'tugas_akhir_1', 'tugas_akhir_2'];

        foreach ($mahasiswas as $mhs) {
            // Pilih dosen pembimbing (acak)
            $dosenPembimbing = $dosens->random();

            // Buat Tugas Akhir
            $tugasAkhir = TugasAkhir::create([
                'id_mahasiswa' => $mhs->id,
                'id_dosen' => $dosenPembimbing->id,
                'judul' => \Faker\Factory::create('id_ID')->sentence(6),
                'dokumen' => json_encode(['dokumen_ta_' . $mhs->nim . '.pdf']),
                'status' => 'proses',
            ]);

            // Pilih jenis sidang
            $jenis = $jenisSidang[array_rand($jenisSidang)];

            // Dosen penguji (berbeda dari pembimbing)
            $dosenPenguji = $dosens->where('id', '!=', $dosenPembimbing->id)->random();

            // Buat Sidang
            Sidang::create([
                'id_mahasiswa' => $mhs->id,
                'id_dosen' => $dosenPembimbing->id,
                'id_periode' => $periode->id,
                'id_tugas_akhir' => $tugasAkhir->id,
                'jenis' => $jenis,
                'status' => 'terjadwal',
                'ruangan' => 'R' . rand(101, 305),
                'tanggal_sidang' => \Carbon\Carbon::create(2025, 10, rand(10, 25), rand(8, 14), 0),
                'dokumen_pendukung' => json_encode(['berkas_pendukung_' . $mhs->nim . '.zip']),
                'id_dosen_penguji' => $dosenPenguji->id,
            ]);
        }
    }
}