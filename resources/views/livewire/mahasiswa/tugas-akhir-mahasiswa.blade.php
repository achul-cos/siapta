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
        <div class="absolute top-26 inset-0 z-0 left-48 bg-[url(../../public/img/pattren/Square-Pattern1-Orange.png)] bg-cover bg-no-repeat opacity-15"></div>

        <!-- Sub Judul -->
        <div class="relative text-dark flex flex-col gap-y-2 p-4 ps-8 pb-8 border-b-2 border-dark shrink-0">
            <p class="text-2xl font-bold">Tugas Akhir</p>
            <p class="text-sm">Pengajuan Tugas Akhir, Pantau Status Tugas Akhir, Memilih Dosen Pebimbing</p>
        </div>

        <!-- Konten Utama -->
        <div class="flex flex-row justify-between w-full flex-1 border-b-2 z-10 border-dark">
            <div class="w-8 text-dark bg-[image:repeating-linear-gradient(315deg,currentColor_0,currentColor_1px,transparent_0,transparent_4%)]"></div>
                <div class="w-full border-x-2 border-dark p-4 px-8 flex flex-col gap-y-8">              
                    <div class="flex flex-col gap-y-4">
                        <p class="text-xl font-bold text-dark border-b-2 pe-4 pb-2">Detail Tugas Akhir</p>
                        <div class="" :class=" sidebarOpen ? 'max-w-[calc(100vw*0.8)]' : 'max-w-[calc(100vw*0.9)]'">
                            <livewire:tugas-akhir-table/>
                        </div>  
                    </div>
                    <form id="tugasAkhir" class="w-full flex flex-col gap-y-8">
                        <p class="w-full text-xl font-bold text-dark border-b-2 pe-4 pb-2">NIM Mahasiswa</p>
                        <flux:input type=text description="NIM anda otomatis terisi" icon="user" class="rounded-full!" value="{{ Auth::user()->nim ?? 'Data Nim Tidak Ada' }}" readonly />
                        <p class="w-full text-xl font-bold text-dark border-b-2 pe-4 pb-2">Dosen Pembimbing</p>
                        <flux:select wire:model.live="dosen_pembimbing" description="Pilih dosen pembimbing untuk tugas akhir anda" placeholder="Pilih Dosen Pembimbing">
                            @foreach ($dosens as $dosen)
                                <flux:select.option value="{{ $dosen->id }}">{{ $dosen->nama }}</flux:select.option>
                            @endforeach
                        </flux:select>            
                        <p class="w-full text-xl font-bold text-dark border-b-2 pe-4 pb-2">Judul Tugas Akhir</p>
                        <flux:input 
                            wire:model="judul_tugas_akhir" 
                            icon="document" 
                            class="rounded-full!" 
                            description="Masukkan Judul Tugas Akhir Anda!"
                            placeholder="Masukkan Judul Tugas Akhir" 
                        />                        
                        <p class="w-full text-xl font-bold text-dark border-b-2 pe-4 pb-2">Dokumen Tugas Akhir dan Pendukung</p>
                        <flux:input wire:model="dokumen" type="file" multiple/>
                        <flux:button variant="primary" class="active:scale-95 active:bg-gray-200! hover:bg-primary-shadow bg-primary text-white transition-all duration-100" wire:click="PengajuanTugasAkhir">Ajukan Tugas Akhir</flux:button>
                    </form>      
                </div>            
            <div class="w-8 text-dark bg-[image:repeating-linear-gradient(315deg,currentColor_0,currentColor_1px,transparent_0,transparent_4%)]"></div>
        </div>
    </div>   
    
</div>
