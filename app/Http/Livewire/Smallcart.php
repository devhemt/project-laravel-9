<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class Smallcart extends Component
{
    protected $listeners = ['loadsmallcart'];
    public $cart;
    public $subtotal,$total;

    public function loadsmallcart(){

    }
    public function render()
    {
        $this->cart = Cart::getContent()->toArray();
        $this->subtotal = Cart::getSubTotal();
        $this->total = Cart::getTotal();
        return view('livewire.smallcart',['cart'=>$this->cart]);
    }
}
