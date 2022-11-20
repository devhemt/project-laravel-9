<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Cart;
use Illuminate\Support\Facades\Auth;

class Quickview extends Component
{
    protected $listeners = ['idView'];
    public $prdQV;
    public $getid;
    public $name,$price,$imagein;
    public $sizes,$colors,$colorclass = null;
    public $getsize;
    public $color;
    public $quantity = 1;
    public $checked = 'Stock';

//    public function mount(){
//        Cart::remove(1);
//    }

    public function getColor($input){
        $this->color = $input;
        $this->colorclass = "active";
    }

    public function addcart($prd_id){
        if($this->getsize == null){
            $trim = trim($this->sizes);
            $size = explode(" ",$trim);
            $this->getsize = $size[0];
        }
        if($this->color == null){
            $trim = trim($this->colors);
            $colorch = explode(" ",$trim);
            $this->color = $colorch[0];
        }
        // issue the same prd but not the same color and size will be solved by checkall
        $userId = Auth::guard("customer")->id();
        Cart::session($userId);
        Cart::add([
            'id' => $prd_id,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'attributes' => array(
                0 => array(
                    'color' => $this->getsize,
                    'size' => $this->color,
                    'image' => $this->imagein,
                )
//                'color' => $this->getsize,
//                'size' => $this->color,
//                'image' => $this->imagein,
            )
        ]);
        $this->emit('loadsmallcart');
//        dd(Cart::getContent()->toArray());
    }

    public function idView($id)
    {
        $this->getid = $id;
    }

    public function render()
    {
        $this->prdQV = DB::table('items')
            ->join('nature1', 'items.prd_id','=', 'nature1.itemsid')
            ->select('items.*','nature1.size','nature1.color')
            ->where('prd_id', $this->getid)->get();
        foreach ($this->prdQV as $p){
            $this->sizes = $p->size;
            $this->colors = $p->color;
            $this->name = $p->name;
            $this->price = $p->price;
            $image = explode(" ",$p->images);
            $this->imagein = $image[0];
        }

        return view('livewire.quickview',['prdQV' => $this->prdQV,'showchose'=>$this->color]);
    }
}
