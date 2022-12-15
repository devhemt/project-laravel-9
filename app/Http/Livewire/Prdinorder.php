<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Prdinorder extends Component
{
    public $idinvoice;
    public $invoice,$cusdetail,$prd;

    public function render()
    {
        $this->invoice = DB::table('invoice')
            ->where('invoice_id', $this->idinvoice)
            ->get();

        $this->cusdetail = DB::table('customer')
            ->where('cus_id', $this->invoice[0]->cusid)
            ->get();

        $this->prd = DB::table('detail_invoice')
            ->join('items', 'items.prd_id','=', 'detail_invoice.itemsid')
            ->where('invoice_id', $this->invoice[0]->invoice_id)
            ->get();


        return view('livewire.admin.prdinorder');
    }
}
