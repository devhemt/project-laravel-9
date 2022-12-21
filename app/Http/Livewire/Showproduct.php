<?php

namespace App\Http\Livewire;

use App\Models\Items;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Showproduct extends Component
{
    use WithPagination;

    protected $listeners = ['searchOut3'];
    protected $paginationTheme = 'bootstrap';
    public $prd, $total;
    public $stockfirst = [],$percentfirst = [];
    public $stocklast = [],$percentlast = [];
    public $checksearch = null;
    public $top = null;
    public $iddelete;

    public function yes(){
        $affected = DB::table('items')
            ->where('prd_id','=', $this->iddelete)
            ->update(['block' => 'blocked']);
        $this->top = null;
    }
    public function no(){
        $this->top = null;
    }
    public function block($id){
        $this->iddelete = $id;
        $this->top = 0;
    }

    public function searchOut3($searchinput){
        $this->checksearch = $searchinput;
    }


    public function render()
    {
        if ($this->checksearch == null){
            $this->prd = Items::all();
            $this->total = Items::all()->count();
            foreach ($this->prd as $p){
                $batchall = DB::table('batch_price')
                    ->where('prdid',$p->prd_id)
                    ->latest('created_at')->first();
                $batchlast = $batchall->batch;
                $batchfirst = $batchlast - 1 ;

                $batchfirstamount = DB::table('batch_price')
                    ->where('prdid',$p->prd_id)
                    ->where('batch','=',$batchfirst)
                    ->first();
                $batchlastamount = DB::table('batch_price')
                    ->where('prdid',$p->prd_id)
                    ->where('batch','=',$batchlast)
                    ->first();

                $countlast = DB::table('properties')
                    ->where('itemsid', $p->prd_id)
                    ->where('batch' , $batchlast)
                    ->get();
                $countlastout = 0;
                foreach ($countlast as $c){
                    $countlastout += $c->amount;
                }
                $this->stocklast[$p->prd_id] = $countlastout;
                $this->percentlast[$p->prd_id] = ($countlastout/$batchlastamount->batch_amount)*100;


                if ($batchfirstamount != null ){
                    $countfirst = DB::table('properties')
                        ->where('itemsid', $p->prd_id)
                        ->where('batch' , $batchfirst)
                        ->get();
                    $countfirstout = 0;
                    foreach ($countfirst as $c){
                        $countfirstout += $c->amount;
                    }
                    $this->stockfirst[$p->prd_id] = $countfirstout;
                    $this->percentfirst[$p->prd_id] = ($countfirstout/$batchfirstamount->batch_amount)*100;
                }

            }

            return view('livewire.admin.showproduct',[
                'products' => Items::where('block','=', null)->latest()->paginate(10),
            ]);
        }else{
            $this->prd = Items::all();
            $this->total = Items::all()->count();
            foreach ($this->prd as $p){
                $batchall = DB::table('batch_price')
                    ->where('prdid',$p->prd_id)
                    ->latest('created_at')->first();
                $batchlast = $batchall->batch;
                $batchfirst = $batchlast - 1 ;

                $batchfirstamount = DB::table('batch_price')
                    ->where('prdid',$p->prd_id)
                    ->where('batch','=',$batchfirst)
                    ->first();
                $batchlastamount = DB::table('batch_price')
                    ->where('prdid',$p->prd_id)
                    ->where('batch','=',$batchlast)
                    ->first();

                $countlast = DB::table('properties')
                    ->where('itemsid', $p->prd_id)
                    ->where('batch' , $batchlast)
                    ->get();
                $countlastout = 0;
                foreach ($countlast as $c){
                    $countlastout += $c->amount;
                }
                $this->stocklast[$p->prd_id] = $countlastout;
                $this->percentlast[$p->prd_id] = ($countlastout/$batchlastamount->batch_amount)*100;


                if ($batchfirstamount != null ){
                    $countfirst = DB::table('properties')
                        ->where('itemsid', $p->prd_id)
                        ->where('batch' , $batchfirst)
                        ->get();
                    $countfirstout = 0;
                    foreach ($countfirst as $c){
                        $countfirstout += $c->amount;
                    }
                    $this->stockfirst[$p->prd_id] = $countfirstout;
                    $this->percentfirst[$p->prd_id] = ($countfirstout/$batchfirstamount->batch_amount)*100;
                }

            }

            return view('livewire.admin.showproduct',[
                'products' => Items::where('name', 'like', '%'.$this->checksearch.'%')->where('block','=', null)->latest()->paginate(10),
            ]);
        }
    }
}
