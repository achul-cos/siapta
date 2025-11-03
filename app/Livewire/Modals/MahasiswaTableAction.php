<?php

namespace App\Livewire\Modals;

use Livewire\Component;

class MahasiswaTableAction extends Component
{
    public bool $myModal1 = false;

    public function render()
    {
        return view('livewire.modals.mahasiswa-table-action');
    }
}
