<div x-data="{ openSidebar: true, openMenu: false, openSidebarMobile: false}" x-init="$watch('openSidebarMobile', val => document.body.classList.toggle('overflow-hidden', val))">

    <nav class="bg-primary fixed top-0 z-10 border-4 border-dark w-screen h-24 max-md:hidden min-md:block">
        <div class="h-full p-4 flex flex-row justify-between items-center transition-all duration-500 ms-46" :class="openSidebar ? 'ms-46' : '!ms-0'">
            <div class="flex flex-col font-sans text-dark truncate" x-data="clock()" x-init="startClock()">
                <p class="text-2xl truncate max-w-[calc(100vw-60vw)]">Hai, <span class="font-bold">{{ Auth::user()->nama ?? 'Nama Pengguna' }}</span></p>
                <p x-text="time" class="truncate max-w-[calc(100vw-60vw)]"></p>
            </div>
            <div class="flex flex-row-reverse items-center gap-4">
                <button @click="openMenu = !openMenu" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-12 h-12 fill-dark hover:fill-primary-shadow transition">
                        <path d="M320 312C386.3 312 440 258.3 440 192C440 125.7 386.3 72 320 72C253.7 72 200 125.7 200 192C200 258.3 253.7 312 320 312zM290.3 368C191.8 368 112 447.8 112 546.3C112 562.7 125.3 576 141.7 576L498.3 576C514.7 576 528 562.7 528 546.3C528 447.8 448.2 368 349.7 368L290.3 368z"/>
                    </svg>
                </button>
                <button @click="openSidebar = !openSidebar; window.dispatchEvent(new CustomEvent('sidebar-toggled', { detail: openSidebar }))">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" :class="sidebarOpen ? 'rotate-0' : 'rotate-90'" class="w-12 h-12 fill-dark hover:fill-primary-shadow transition-all"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 160C96 142.3 110.3 128 128 128L512 128C529.7 128 544 142.3 544 160C544 177.7 529.7 192 512 192L128 192C110.3 192 96 177.7 96 160zM96 320C96 302.3 110.3 288 128 288L512 288C529.7 288 544 302.3 544 320C544 337.7 529.7 352 512 352L128 352C110.3 352 96 337.7 96 320zM544 480C544 497.7 529.7 512 512 512L128 512C110.3 512 96 497.7 96 480C96 462.3 110.3 448 128 448L512 448C529.7 448 544 462.3 544 480z"/></svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile -->
    <nav class="bg-primary fixed top-0 z-10 border-4 border-dark w-screen h-24 min-md:hidden max-md:block">
        <div class="h-full p-4 flex flex-row justify-between items-center transition-all duration-500">
            <div class="flex flex-col font-sans text-dark" x-data="clock()" x-init="startClock()">
                <p class="text-2xl truncate max-w-[calc(100vw-60vw)]">Hai, <span class="font-bold">{{ Auth::user()->nama ?? 'Nama Pengguna' }}</span></p>
                <p x-text="time" class="truncate max-w-[calc(100vw-60vw)]"></p>
            </div>
            <div class="flex flex-row-reverse items-center gap-4">

                <!-- Profil Icon -->
                <button @click="openMenu = !openMenu" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-12 h-12 fill-dark hover:fill-primary-shadow transition">
                        <path d="M320 312C386.3 312 440 258.3 440 192C440 125.7 386.3 72 320 72C253.7 72 200 125.7 200 192C200 258.3 253.7 312 320 312zM290.3 368C191.8 368 112 447.8 112 546.3C112 562.7 125.3 576 141.7 576L498.3 576C514.7 576 528 562.7 528 546.3C528 447.8 448.2 368 349.7 368L290.3 368z"/>
                    </svg>
                </button>

                <!-- Hamburger icon - Mobile -->
                <button @click="openSidebarMobile = !openSidebarMobile; window.dispatchEvent(new CustomEvent('sidebar-toggled', { detail: openSidebarMobile }))">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" :class="openSidebarMobile ? 'rotate-90' : 'rotate-0'" class="w-12 h-12 fill-dark hover:fill-primary-shadow transition-all"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 160C96 142.3 110.3 128 128 128L512 128C529.7 128 544 142.3 544 160C544 177.7 529.7 192 512 192L128 192C110.3 192 96 177.7 96 160zM96 320C96 302.3 110.3 288 128 288L512 288C529.7 288 544 302.3 544 320C544 337.7 529.7 352 512 352L128 352C110.3 352 96 337.7 96 320zM544 480C544 497.7 529.7 512 512 512L128 512C110.3 512 96 497.7 96 480C96 462.3 110.3 448 128 448L512 448C529.7 448 544 462.3 544 480z"/></svg>
                </button>                
            </div>
        </div>
    </nav>     

    <aside
        x-cloak
        x-show="openSidebar"
        x-transition:enter="transform transition ease-in-out duration-500"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition ease-in-out duration-500"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="-translate-x-full"
        class="bg-primary border-4 border-dark fixed top-0 left-0 h-full w-48 z-40 shadow-lg max-md:hidden">
        <div class="w-full h-full flex flex-col">
            <div class="items-center p-4 h-22.5 flex justify-center">
                <p class="text-3xl text-center font-bold">Siap<span class="text-black/50">TA</span></p>
            </div>
            <div class="items-start flex flex-col">
                <a href="{{ route('koordinator.kelola-sidang') }}" wire:navigate wire:current="bg-primary-shadow/50" class="hover:bg-primary-shadow transition duration-100 border-dark border-t-2 border-b-2 p-4 w-full flex flex-row gap-2">
                    <div>
                        <x-iconsax-bol-judge class="w-6 h-6 fill-black/50" />                         
                    </div>
                    <div class="font-bold">
                        Kelola Sidang
                    </div>                    
                </a>                                                                  
                <a href="{{ route('koordinator.tugas-akhir') }}" wire:navigate wire:current="bg-primary-shadow/50" class="hover:bg-primary-shadow transition duration-100 border-dark border-b-2 p-4 w-full flex flex-row gap-2">
                    <div>
                        <x-heroicon-s-document-plus class="w-6 h-6 fill-black/50" />                        
                    </div>
                    <div class="font-bold">
                        Tugas Akhir
                    </div>
                </a>                                                                             
                <a href="{{ route('koordinator.kelola-dosen') }}" wire:navigate wire:current="bg-primary-shadow/50" class="hover:bg-primary-shadow transition duration-100 border-dark border-b-2 p-4 w-full flex flex-row gap-2">
                    <div>
                        <x-phosphor-chalkboard-teacher-fill class="w-6 h-6 fill-black/50" />                        
                    </div>
                    <div class="font-bold">
                        Kelola Dosen
                    </div>
                </a>                                                                             
                <a href="{{ route('koordinator.kelola-mahasiswa') }}" wire:navigate wire:current="bg-primary-shadow/50" class="hover:bg-primary-shadow transition duration-100 border-dark border-b-2 p-4 w-full flex flex-row gap-2">
                    <div>
                        <x-iconsax-bol-teacher class="w-6 h-6 fill-black/50" />                        
                    </div>
                    <div class="font-bold">
                        Kelola Mahasiswa
                    </div>
                </a>                                                                             
            </div>
            <div class="flex flex-col mt-auto p-4">
                <p class="text-2xl">
                    SiapTA, <span class="font-bold">koordinator</span>
                </p>
            </div>            
        </div>
    </aside>

    <!-- Mobile -->
    <aside class="bg-primary border-4 border-dark fixed top-0 left-0 h-full w-48 z-40 shadow-xl min-md:hidden"
        x-show="openSidebarMobile"
        x-transition:enter="transform transition ease-in-out duration-500"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition ease-in-out duration-500"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-cloak
        @click.outside="openSidebarMobile = false"
        x-transition:leave-end="-translate-x-full">
        <div class="w-full h-full flex flex-col">
            <div class="items-center p-4 h-22.5 flex justify-center">
                <p class="text-3xl text-center font-bold">Siap<span class="text-black/50">TA</span></p>
            </div>
            <div class="items-start flex flex-col">
                <a href="{{ route('koordinator.kelola-sidang') }}" wire:navigate wire:current="bg-primary-shadow/50" class="hover:bg-primary-shadow transition duration-100 border-dark border-t-2 border-b-2 p-4 w-full flex flex-row gap-2">
                    <div>
                        <x-iconsax-bol-judge class="w-6 h-6 fill-black/50" />                         
                    </div>
                    <div class="font-bold">
                        Kelola Sidang
                    </div>                    

                </a>                                                                  
                <a href="{{ route('koordinator.tugas-akhir') }}" wire:navigate wire:current="bg-primary-shadow/50" class="hover:bg-primary-shadow transition duration-100 border-dark border-b-2 p-4 w-full flex flex-row gap-2">
                    <div>
                        <x-heroicon-s-document-plus class="w-6 h-6 fill-black/50" />                        
                    </div>
                    <div class="font-bold">
                        Tugas Akhir
                    </div>
                </a>
                <a href="{{ route('koordinator.kelola-dosen') }}" wire:navigate wire:current="bg-primary-shadow/50" class="hover:bg-primary-shadow transition duration-100 border-dark border-b-2 p-4 w-full flex flex-row gap-2">
                    <div>
                        <x-phosphor-chalkboard-teacher-fill class="w-6 h-6 fill-black/50" />                        
                    </div>
                    <div class="font-bold">
                        Kelola Dosen
                    </div>
                </a>                                                                             
                <a href="{{ route('koordinator.kelola-mahasiswa') }}" wire:navigate wire:current="bg-primary-shadow/50" class="hover:bg-primary-shadow transition duration-100 border-dark border-b-2 p-4 w-full flex flex-row gap-2">
                    <div>
                        <x-iconsax-bol-teacher class="w-6 h-6 fill-black/50" />                        
                    </div>
                    <div class="font-bold">
                        Kelola Mahasiswa
                    </div>
                </a>                                              
            </div>
            <div class="flex flex-col mt-auto p-4">
                <p class="text-2xl">
                    SiapTA, <span class="font-bold">koordinator</span>
                </p>
            </div>              
        </div>
    </aside>    

    <menu
    x-show="openMenu"
    x-cloak
    @click.outside="openMenu = false"
    x-transition
    class="fixed top-28 right-4 w-48 z-40 bg-white rounded-2xl border-2 border-dark shadow-xl">        
        <div class="p-4 text-dark">
            <p class="font-bold text-2xl">
                {{ Auth::user()->nama ?? 'Nama Pengguna' }}
            </p>
            <p class="text-sm">
                koordinator
            </p>
        </div>
        <!-- <a href="" wire:navigate class="group hover:bg-dark hover:text-white transition duration-100 border-y-2 border-dark font-sans text-base p-2 px-4 flex flex-row gap-2 text-dark items-center">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-4 h-4 fill-dark group-hover:fill-white"><path d="M259.1 73.5C262.1 58.7 275.2 48 290.4 48L350.2 48C365.4 48 378.5 58.7 381.5 73.5L396 143.5C410.1 149.5 423.3 157.2 435.3 166.3L503.1 143.8C517.5 139 533.3 145 540.9 158.2L570.8 210C578.4 223.2 575.7 239.8 564.3 249.9L511 297.3C511.9 304.7 512.3 312.3 512.3 320C512.3 327.7 511.8 335.3 511 342.7L564.4 390.2C575.8 400.3 578.4 417 570.9 430.1L541 481.9C533.4 495 517.6 501.1 503.2 496.3L435.4 473.8C423.3 482.9 410.1 490.5 396.1 496.6L381.7 566.5C378.6 581.4 365.5 592 350.4 592L290.6 592C275.4 592 262.3 581.3 259.3 566.5L244.9 496.6C230.8 490.6 217.7 482.9 205.6 473.8L137.5 496.3C123.1 501.1 107.3 495.1 99.7 481.9L69.8 430.1C62.2 416.9 64.9 400.3 76.3 390.2L129.7 342.7C128.8 335.3 128.4 327.7 128.4 320C128.4 312.3 128.9 304.7 129.7 297.3L76.3 249.8C64.9 239.7 62.3 223 69.8 209.9L99.7 158.1C107.3 144.9 123.1 138.9 137.5 143.7L205.3 166.2C217.4 157.1 230.6 149.5 244.6 143.4L259.1 73.5zM320.3 400C364.5 399.8 400.2 363.9 400 319.7C399.8 275.5 363.9 239.8 319.7 240C275.5 240.2 239.8 276.1 240 320.3C240.2 364.5 276.1 400.2 320.3 400z"/></svg>
            </div>
            <div>
                Kelola Profil
            </div>
        </a> -->
        <a href="{{ route('logout') }}" wire:navigate class="group hover:bg-dark hover:text-white hover:bg-primary transition duration-100 border-t-2 rounded-b-xl font-sans text-base p-2 px-4 flex flex-row gap-2 text-dark items-center">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-4 h-4 fill-dark group-hover:fill-white"><path d="M384 128L448 128L448 544C448 561.7 462.3 576 480 576L512 576C529.7 576 544 561.7 544 544C544 526.3 529.7 512 512 512L512 128C512 92.7 483.3 64 448 64L352 64L352 64L192 64C156.7 64 128 92.7 128 128L128 512C110.3 512 96 526.3 96 544C96 561.7 110.3 576 128 576L352 576C369.7 576 384 561.7 384 544L384 128zM256 320C256 302.3 270.3 288 288 288C305.7 288 320 302.3 320 320C320 337.7 305.7 352 288 352C270.3 352 256 337.7 256 320z"/></svg>        </div>
            <div>
                Keluar
            </div>
        </a>    
    </menu>

</div>