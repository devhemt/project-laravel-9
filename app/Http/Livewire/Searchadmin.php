<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Searchadmin extends Component
{
    public $searchinput;
    public $currentURL;


    public function search($currentURL){

        if ($currentURL === 'admin/product'){
            $this->emit('searchOut3', $this->searchinput);
        }
        if ($currentURL === 'admin/noprocessorder'||$currentURL === 'admin/canceledorder'){
            $this->emit('searchOut5', $this->searchinput);
        }
    }

    public function render()
    {
        return view('livewire.admin.searchadmin');
    }
}
