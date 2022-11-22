<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\DB;

class Truecart extends Component
{
    public $cart;
    public $totalquantity = 0;
    public $total;

    public function checkInvoice($prd_id,$size,$color){
        $product = DB::table('detail_invoice')
            ->join('invoice', 'detail_invoice.invoice_id','=', 'invoice.invoice_id')
            ->join('status', 'invoice.invoice_id','=', 'status.invoice_id')
            ->select('detail_invoice.*','status.status')
            ->where('detail_invoice.itemsid','=', $prd_id)
            ->where('detail_invoice.size','=',$size)
            ->where('detail_invoice.color','=',$color)
            ->get();

        $totalamount = 0;
        foreach ($product as $c){
            $totalamount += $c['amount'];
        }

        return $totalamount;
    }

    public function checkBatch($prd_id,$batch){
        $prdbatch = DB::table('batch_price')
                ->where('prdid','=',$prd_id)
                ->where('batch','=',$batch)
                ->get();

        $totalamount ;
        foreach ($prdbatch as $p){
            $totalamount = $p['batch_amount'];
        }

        return $totalamount;
    }

    public function register(){
        if (Auth::guard("customer")->check()){
            $userId = Auth::guard("customer")->id();
            Cart::session($userId);
            if (Cart::isEmpty()){
                dd("mua hang di dm");
            }else{
                $cartin = Cart::getContent()->toArray();
                foreach ($cartin as $c){
                    $prdbatch = DB::table('batch_price')
                        ->where('prdid','=',$c['id'])
                        ->get();
                    $length = count($prdbatch);
                    $check = 0;
                    for ($i=1;$i<=$length;$i++){
                        $check += $this->checkBatch($c['id'],$i);
                        if (($this->checkInvoice($c['id'],$c['attributes'][0]['image'],$c['attributes'][0]['size'])+$c['quantity'])<=$check){

                            break;
                        }
                    }

                }
            }
        }else{
            $this->emit('showTakeInfor');
        }
    }

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
