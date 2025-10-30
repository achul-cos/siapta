<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TugasAkhir;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use DateTimeInterface;
use App\Http\Controllers\AuthController;

class TugasAkhirTable extends DataTableComponent
{
    protected $model = TugasAkhir::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    /**
     * Override query berdasarkan guard yang login
     */
    public function builder(): Builder
    {
        $query = TugasAkhir::query()->with(['dosen', 'mahasiswa', 'sidang']);

        if (auth('koordinator')->check()) {
            return $query;
        }
        elseif (auth('dosen')->check()) {
            $dosenId = auth('dosen')->user()->id;
            $query->where('id_dosen', $dosenId);
        }
        elseif (auth('mahasiswa')->check()) {
            $mahasiswaId = auth('mahasiswa')->user()->id;
            $query->where('id_mahasiswa', $mahasiswaId);
        }

        return $query;
    }   

    public function columns(): array
    {
        $columns = [
            Column::make('Id', 'id')
                ->sortable(),
        ];

        // Tambahkan kolom Id Mahasiswa hanya jika yang login BUKAN mahasiswa
        if (!auth('mahasiswa')->check()) {
            $columns[] = Column::make('Mahasiwa', 'mahasiswa.nama')
                ->sortable()
                ->searchable();
        }

        $columns = array_merge($columns, [
            Column::make('Dosen Pembimbing', 'dosen.nama')
                ->sortable(),
            Column::make("Judul", "judul")
                ->sortable(),
            Column::make("Dokumen", "dokumen")
                ->sortable()
                ->format(function ($value) {
                    try {
                        $dokumen = json_decode($value, true) ?? [];
                        
                        if (empty($dokumen)) {
                            return '-';
                        }
                        
                        // Convert all values to string safely
                        $dokumenStrings = array_map(function($item) {
                            if (is_array($item)) {
                                return implode(' - ', array_map('strval', $item));
                            }
                            return (string) $item;
                        }, $dokumen);
                        
                        return implode(', ', $dokumenStrings);
                        
                    } catch (\Exception $e) {
                        return '-';
                    }
                }),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ]);

        return $columns;
    }
}
