<div class="w-full h-full">
    <div class="w-full min-h-screen h-full flex justify-center items-center p-8">
        <form class="p-8 border-gray-600 border-2 rounded-2xl shadow-lg flex flex-col justify-center items-center gap-4 bg-white" wire:submit="autentikasi">
            <div class="w-full border-b-2 border-gray-200 pb-4">
                <p class="text-3xl text-center font-bold">Siap<span class="text-primary">TA</span></p>
            </div>

            <div class="w-full flex flex-col gap-4 border-gray-200 pb-4">
                <flux:select wire:model.live="pengguna" label="Jenis Pengguna">
                    <flux:select.option value="" selected>Pilih Pengguna</flux:select.option>
                    <flux:select.option value="mahasiswa">Mahasiswa</flux:select.option>
                    <flux:select.option value="dosen">Dosen</flux:select.option>
                    <flux:select.option value="koordinator">Koordinator</flux:select.option>
                </flux:select>                
                
                <flux:input icon="user" wire:model="login" label="NIM/NIP" placeholder="NIM/NIP Anda" clearable />
                
                <flux:input icon="key" wire:model="password" label="Kata Sandi" placeholder="Kata Sandi Anda" type="password" viewable />
            </div>
            
            <div class="w-full justify-end flex">
                <flux:button variant="primary" 
                           class="active:scale-95 active:bg-gray-200! hover:bg-primary-shadow bg-primary text-white transition-all duration-100" 
                           wire:click="autentikasi"
                           wire:loading.attr="disabled">
                    <span wire:loading.remove>Masuk</span>
                    <span wire:loading>Memproses...</span>
                </flux:button>
            </div>
        </form>
    </div>   
</div>