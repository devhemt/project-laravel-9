<?php

namespace App\Http\Livewire;

use App\Models\Items;
use Livewire\Component;
use Livewire\WithPagination;

class Showproduct extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function render()
    {

        return view('livewire.showproduct',[
            'products' => Items::latest()->paginate(10),
        ]);
    }
}
