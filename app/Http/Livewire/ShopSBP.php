<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShopSBP extends Component
{
    public $options = ['$50-$100','$100-$200','$200-more','all'];
    public $status;


    public function render()
    {
        if($this->status != null && $this->status =='best selling'){
            $this->emit('bestSell');
        }

        if($this->status != null && $this->status =='default sort'){
            $this->emit('default');
        }

        return view('livewire.client.shop-s-b-p');
    }
}
