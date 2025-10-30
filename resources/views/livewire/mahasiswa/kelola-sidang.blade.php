<div class="w-full h-full">

    <livewire:mahasiswa.sidebar/>

    <!-- Success Modal -->
    @if (session('success'))
        <livewire:components.success/>
    @endif

    <!-- Failed Modal -->
    @if (session('failed'))
        <livewire:components.failed/>
    @endif     

    <div class="relative w-full z-0 min-h-[calc(100vh)] pt-28 flex flex-col bg-cover bg-no-repeat bg-top-right overflow-hidden transition-all duration-500 max-md:ps-0 min-md:ps-48"
         :class="sidebarOpen ? 'min-md:!ps-48 max-md:!ps-0' : 'min-md:!ps-0 max-md:!ps-0'">
        <!-- Background -->
        <div class="absolute top-26 inset-0 z-0 left-48 bg-[url(../../public/img/pattren/Square-Pattern1-primary.png)] bg-cover bg-no-repeat opacity-15"></div>

        <!-- Sub Judul -->
        <div class="relative text-dark flex flex-col gap-y-2 p-4 ps-8 pb-8 border-b-2 border-dark shrink-0">
            <p class="text-2xl font-bold">Pantau Sidang</p>
            <p class="text-sm">Mengajukan Sidang Tugas Akhir Proposal, Tugas Akhir 1, Tugas Akhir 2, Melihat Riwayat Sidang.</p>
        </div>

        <!-- Konten Utama -->
        <div class="flex flex-row justify-between w-full flex-1 border-b-2 z-10 border-dark">
            <div class="w-8 text-dark bg-[image:repeating-linear-gradient(315deg,currentColor_0,currentColor_1px,transparent_0,transparent_4%)]"></div>
            <div class="w-full border-x-2 border-dark p-4 px-8 flex flex-col gap-y-8">              
                <div class="flex flex-col gap-y-4">
                    <p class="text-xl font-bold text-dark border-b-2 pe-4 pb-2">Detail Sidang</p>
                    <div class="" :class=" sidebarOpen ? 'max-w-[calc(100vw*0.8)]' : 'max-w-[calc(100vw*0.9)]'">
                        <livewire:pantau-sidang-table/>
                    </div>  
                </div>
                <form id="kelolaSidang" class="flex flex-col gap-y-8 w-full">
                    <p class="w-full text-xl font-bold text-dark border-b-2 pe-4 pb-2">Jenis Sidang</p>
                    <flux:select wire:model.live="jenis_sidang" description="Pilih jenis sidang tugas akhir anda" placeholder="Pilih Jenis Sidang">
                        <flux:select.option value="seminar">Sidang Proposal</flux:select.option>
                        <flux:select.option value="tugas_akhir_1">Sidang TA 1</flux:select.option>
                        <flux:select.option value="tugas_akhir_2">Sidang TA 2</flux:select.option>
                    </flux:select>                                 
                    <p class="w-full text-xl font-bold text-dark border-b-2 pe-4 pb-2">Periode Sidang</p>
                    @if ($noPeriode)
                        <flux:select 
                            wire:model.live="periode_id" 
                            description="Sidang belum dibuka oleh koordinator." 
                            disabled
                        >
                            <flux:select.option value="" selected disabled>
                                Sidang Belum Dibuka
                            </flux:select.option>
                        </flux:select>
                    @else
                        <flux:select 
                            wire:model.live="periode_id" 
                            description="Pilih periode sidang yang tersedia" 
                        >
                            <flux:select.option value="" disabled selected>Pilih Periode</flux:select.option>
                            @foreach ($periodes as $id => $nama)
                                <flux:select.option value="{{ $id }}">{{ $nama }}</flux:select.option>
                            @endforeach
                        </flux:select>
                    @endif
                    <p class="w-full text-xl font-bold text-dark border-b-2 pe-4 pb-2">NIM Mahasiswa</p>
                    <flux:input type=text description="NIM anda otomatis terisi" icon="user" class="rounded-full!" value="{{ Auth::user()->nim ?? 'Data Nim Tidak Ada' }}" readonly />
                    <p class="w-full text-xl font-bold text-dark border-b-2 pe-4 pb-2">Judul Tugas Akhir</p>
                    @if ($noTugasAkhir)
                        <flux:select disabled description="Anda belum memiliki tugas akhir.">
                            <flux:select.option value="" selected disabled>Tidak Ada Tugas Akhir</flux:select.option>
                        </flux:select>
                    @else
                        <flux:select wire:model.live="tugas_akhir_id" description="Pilih tugas akhir yang akan didaftarkan">
                            <flux:select.option value="" disabled selected>Pilih Tugas Akhir</flux:select.option>

                            @foreach ($tugas_akhirs as $id => $ta)
                                @if ($ta['disabled'])
                                    <flux:select.option value="{{ $id }}" disabled class="text-gray-500">
                                        {{ $ta['judul'] }} ({{ $ta['status'] }})
                                    </flux:select.option>
                                @else
                                    <flux:select.option value="{{ $id }}">
                                        {{ $ta['judul'] }} ({{ $ta['status'] }})
                                    </flux:select.option>
                                @endif
                            @endforeach
                        </flux:select>
                    @endif              
                    <p class="w-full text-xl font-bold text-dark border-b-2 pe-4 pb-2">Dosen Pebimbing</p>
                    <flux:input 
                            wire:model="dosen_pembimbing" 
                            icon="users" 
                            class="rounded-full!" 
                            description="Dosen pembimbing otomatis terisi" 
                            readonly 
                        />
                    <p class="w-full text-xl font-bold text-dark border-b-2 pe-4 pb-2">Dokumen Pendukung</p>
                    <flux:input wire:model="dokumen" type="file" multiple/>
                    <flux:button variant="primary" class="active:scale-95 active:bg-gray-200! hover:bg-primary-shadow bg-primary text-white transition-all duration-100" wire:click="daftarSidang">Daftar Sidang</flux:button>
                </form>                
            </div>
            <div class="w-8 text-dark bg-[image:repeating-linear-gradient(315deg,currentColor_0,currentColor_1px,transparent_0,transparent_4%)]"></div>
        </div>
    </div>    
    
</div>
