<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Searchadmin extends Component
{
    public $searchinput;
    public $currentURL;


    public function search($currentURL){
//        dd($currentURL);
        if ($currentURL === 'http://127.0.0.1:8000/admin/product'){
            $this->emit('searchOut3', $this->searchinput);
        }
        if ($currentURL === 'http://127.0.0.1:8000/admin/noprocessorder'){
            $this->emit('searchOut5', $this->searchinput);
        }
    }

    public function render()
    {
        return view('livewire.admin.searchadmin');
    }
}
