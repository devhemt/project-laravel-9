<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Editprd extends Component
{
    public $idprd;
    public $product, $count, $images, $p1, $batch, $cost;
    public $options;
    public $type = 'Batch old';

    public function render()
    {
        $this->product = DB::table('items')
            ->join('category','items.prd_id','category.prdid')
            ->join('provideds','items.provided','provideds.id')
            ->where('items.prd_id', $this->idprd)->get();


        $this->images = DB::table('images')
            ->where('itemsid', $this->idprd)->get();
        $batch = DB::table('batch_price')
            ->where('prdid', $this->idprd)
            ->latest('created_at')->first();
        $batch1 = DB::table('batch_price')
            ->where('prdid', $this->idprd)
            ->latest('created_at')->first();
        $batchcount = DB::table('batch_price')
            ->where('prdid', $this->idprd)
            ->latest('created_at')->count();

        if ($batchcount > 1){
            $this->options = ['Batch old','Batch new'];
            if ($this->type == 'Batch new'){
                $this->batch = $batch->batch;
                $this->p1 = DB::table('properties')
                    ->where('itemsid', $this->idprd)
                    ->where('batch', $batch->batch)
                    ->get()->toArray();
                $this->count = DB::table('properties')
                    ->where('itemsid', $this->idprd)
                    ->where('batch', $batch->batch)
                    ->get()->count();
                $this->cost = DB::table('batch_price')
                    ->where('prdid', $this->idprd)
                    ->where('batch', $batch->batch)
                    ->get();
            }else{
                $this->batch = $batch->batch-1;
                $this->p1 = DB::table('properties')
                    ->where('itemsid', $this->idprd)
                    ->where('batch', ($batch->batch-1))
                    ->get()->toArray();
                $this->count = DB::table('properties')
                    ->where('itemsid', $this->idprd)
                    ->where('batch', ($batch->batch-1))
                    ->get()->count();
                $this->cost = DB::table('batch_price')
                    ->where('prdid', $this->idprd)
                    ->where('batch', ($batch->batch-1))
                    ->get();
            }
        }else{
            $this->options = ['Batch old'];
            $this->batch = $batch->batch;
            $this->p1 = DB::table('properties')
                ->where('itemsid', $this->idprd)
                ->where('batch', $batch->batch)
                ->get()->toArray();
            $this->count = DB::table('properties')
                ->where('itemsid', $this->idprd)
                ->where('batch', $batch->batch)
                ->get()->count();
            $this->cost = DB::table('batch_price')
                ->where('prdid', $this->idprd)
                ->where('batch', $batch->batch)
                ->get();
        }


        return view('livewire.admin.editprd');
    }
}
