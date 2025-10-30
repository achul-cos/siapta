<div x-data="{ show: true }" x-show="show" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/25">
    <div name="succes" class="min-w-[calc(100vw*0.3)] overflow-hidden bg-white flex flex-col rounded-2xl border-2 border-dark p-0" tabindex="-1">
        <div class="p-4 bg-primary text-text w-full items-center border-b-2 border-dark flex flex-row justify-between relative">
            <p class="font-bold! text-xl! font-sans! text-dark!">
                Gagal
            </p>
            <div class="p-2 rounded-full bg-primary-shadow border-2 border-black active:scale-80 duration-100 transition-all" @click="show = false">
                <x-heroicon-o-x-mark class="w-4 h-4 fill-dark"/>   
            </div>
        </div>
        <div class="p-8 bg-white w-full min-md:pb-12 rounded-b-2xl items-center justify-center flex flex-col gap-4">
            <div class="w-40 h-40">
                <video class="w-full h-full" autoplay loop muted
                    onloadeddata="this.playbackRate=0.25">
                    <source src="{{ asset('img/gif/gagal.webm') }}" type="video/webm">
                </video>
            </div>
            <div class="w-full h-full flex flex-col gap-2 items-center">
                <p class="text-xl font-bold text-dark max-w-lg text-center">{{ session('failed') ?? 'Terjadi Kesalahan' }}</p>
                <p class="text-sm text-black/25">Silahkan Coba Lagi</p>
            </div>
        </div>
    </div>
</div>