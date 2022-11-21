<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Cart;

class Truecart extends Component
{
    public $cart;
    public $totalquantity = 0;
    public $total;

    public function minus($id){
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            Cart::session($userId);
        }else{
            $userId = Session::getId();
        }
        $thiscartquantity = Cart::get($id);
        $minus = $thiscartquantity['quantity'];
        $minus--;

        if ($minus == 0){
            dd('ghsdhgfsd');
        }else{
            Cart::update($id, array(
                'quantity' => -1,
            ));
        }
        $this->emit('loadsmallcart');
    }

    public function plus($id){
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            Cart::session($userId);
        }else{
            $userId = Session::getId();
        }
        $thiscartquantity = Cart::get($id);
        $plus = $thiscartquantity['quantity'];
        $plus++;

        if ($plus == 0){
            dd('ghsdhgfsd');
        }else{
            Cart::update($id, array(
                'quantity' => 1,
            ));
        }
        $this->emit('loadsmallcart');
    }

    public function render()
    {
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            Cart::session($userId);
        }else{
            $userId = Session::getId();
        }
        $this->cart = Cart::getContent()->toArray();
        $this->total = Cart::getTotal();

        $this->totalquantity = 0;
        foreach ($this->cart as $c){
            $this->totalquantity++ ;
        }


        return view('livewire.truecart');
    }
}
