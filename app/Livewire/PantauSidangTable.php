<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Sidang;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class PantauSidangTable extends DataTableComponent
{
    protected $model = Sidang::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableAttributes(['class' => 'table table-striped']);
    }

    /**
     * Override query berdasarkan guard yang login
     */
    public function builder(): Builder
    {        
        $query = Sidang::query()->with(['dosen', 'mahasiswa', 'periode', 'tugasAkhir']);

        if (auth('koordinator')->check()) {
            return $query;
        }
        elseif (auth('dosen')->check()) {
            $dosenId = auth('dosen')->id();
            // return $query->whereHas('dosen', function ($q) use ($dosenId) {
            //     $q->where('dosen.id', $dosenId);
            // });
        }
        elseif (auth('mahasiswa')->check()) {
            $mahasiswaId = auth('mahasiswa')->id();
            return $query->whereHas('mahasiswa', function ($q) use ($mahasiswaId) {
                $q->where('mahasiswa.id', $mahasiswaId);
            });
        }

        return $query;
    }

    public function columns(): array
    {
        $columns = [
            Column::make('Id', 'id')->sortable(),
        ];

        if (!auth('mahasiswa')->check()) {
            $columns[] = Column::make('Nama Mahasiswa', 'mahasiswa.nama')
                ->sortable()
                ->searchable();
        }

        // Tambahkan kolom lainnya
        $columns = array_merge($columns, [
            Column::make('Dosen Pembimbing', 'dosen.nama')
                ->sortable()
                ->searchable(),

            Column::make('Periode Sidang', 'periode.nama_periode')
                ->sortable()
                ->searchable(),

            Column::make('Jenis', 'jenis')
                ->sortable(),

            Column::make('Status', 'status')
                ->sortable()
                ->format(fn($value) => ucfirst($value)),

            Column::make('Ruangan', 'ruangan')
                ->sortable(),

            Column::make('Tanggal Sidang', 'tanggal_sidang')
                ->sortable()
                ->format(function ($value) {
                    return $value ? Carbon::parse($value)->format('d/m/Y H:i') : '-';
                }),

            Column::make('Judul Tugas Akhir', 'tugasAkhir.judul')
                ->sortable()
                ->searchable(),

            Column::make('Dokumen Pendukung', 'dokumen_pendukung')
                ->sortable()
                ->format(fn($value) => $value ? 'Ada' : 'Tidak ada'),

            Column::make('Dibuat', 'created_at')
                ->sortable()
                ->format(fn($value) => $value?->format('d/m/Y H:i') ?? '-'),

            Column::make('Diperbarui', 'updated_at')
                ->sortable()
                ->format(fn($value) => $value?->format('d/m/Y H:i') ?? '-'),
        ]);

        return $columns;
    }  
}