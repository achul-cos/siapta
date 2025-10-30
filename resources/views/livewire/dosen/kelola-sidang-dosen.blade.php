<div class="w-full h-full">

    <livewire:dosen.sidebar/>

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
            <p class="text-2xl font-bold">Kelola Sidang</p>
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
            </div>
            <div class="w-8 text-dark bg-[image:repeating-linear-gradient(315deg,currentColor_0,currentColor_1px,transparent_0,transparent_4%)]"></div>
        </div>
    </div>    
    
</div>
