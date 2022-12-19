<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Revenuecard extends Component
{
    public $time = 'Today';
    public $amount, $percent, $status, $class;

    public function today(){
        $this->time = 'Today';
    }
    public function thismonth(){
        $this->time = 'This month';
    }
    public function thisyear(){
        $this->time = 'This year';
    }

    public function render()
    {
        if ($this->time == 'Today'){
            $now = Carbon::now();
            $product = DB::table('detail_invoice')
                ->whereDay('created_at', '=', $now->day)
                ->get();
            $amount = 0;
            foreach ($product as $p){
                $amount += $p->amount;
            }
            $product1 = DB::table('detail_invoice')
                ->whereDay('created_at', '=', $now->day-1)
                ->get();
            $amount1 = 0;
            foreach ($product1 as $p){
                $amount1 += $p->amount;
            }
            if ($amount!=0 && $amount1 !=0){
                if ($amount > $amount1){
                    $this->percent = (($amount-$amount1)/$amount1)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($amount = $amount1){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($amount < $amount1){
                    $this->percent = (($amount1-$amount)/$amount1)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($amount != 0 && $amount1 ==0){
                $this->percent= 100;
                $this->status = 'no sales yesterday';
                $this->class = 'text-success';
            }
            if ($amount == 0 && $amount1 !=0){
                $this->percent= 0;
                $this->status = 'no sales today';
                $this->class = 'text-danger';
            }
            if ($amount == 0 && $amount1 ==0){
                $this->percent= 0;
                $this->status = 'no sales yesterday and today';
                $this->class = 'text-success';
            }
            $this->amount=$amount;
        }
        if ($this->time == 'This month'){
            $now = Carbon::now();
            $product = DB::table('detail_invoice')
                ->whereMonth('created_at', '=', $now->month)
                ->get();
            $amount = 0;
            foreach ($product as $p){
                $amount += $p->amount;
            }
            $product1 = DB::table('detail_invoice')
                ->whereMonth('created_at', '=', $now->month-1)
                ->get();
            $amount1 = 0;
            foreach ($product1 as $p){
                $amount1 += $p->amount;
            }
            if ($amount!=0 && $amount1 !=0){
                if ($amount > $amount1){
                    $this->percent = (($amount-$amount1)/$amount1)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($amount = $amount1){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($amount < $amount1){
                    $this->percent = (($amount1-$amount)/$amount1)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($amount != 0 && $amount1 ==0){
                $this->percent= 100;
                $this->status = 'no sales last month';
                $this->class = 'text-success';
            }
            if ($amount == 0 && $amount1 !=0){
                $this->percent= 0;
                $this->status = 'no sales this month';
                $this->class = 'text-danger';
            }
            if ($amount == 0 && $amount1 ==0){
                $this->percent= 0;
                $this->status = 'no sales last month and this month';
                $this->class = 'text-success';
            }
            $this->amount=$amount;
        }
        if ($this->time == 'This year'){
            $now = Carbon::now();
            $product = DB::table('detail_invoice')
                ->whereYear('created_at', '=', $now->year)
                ->get();
            $amount = 0;
            foreach ($product as $p){
                $amount += $p->amount;
            }
            $product1 = DB::table('detail_invoice')
                ->whereYear('created_at', '=', $now->year-1)
                ->get();
            $amount1 = 0;
            foreach ($product1 as $p){
                $amount1 += $p->amount;
            }
            if ($amount!=0 && $amount1 !=0){
                if ($amount > $amount1){
                    $this->percent = (($amount-$amount1)/$amount1)*100;
                    $this->status = 'increase';
                    $this->class = 'text-success';
                }
                if ($amount = $amount1){
                    $this->percent = 0;
                    $this->status = 'the same';
                    $this->class = 'text-success';
                }
                if ($amount < $amount1){
                    $this->percent = (($amount1-$amount)/$amount1)*100;
                    $this->status = 'decrease';
                    $this->class = 'text-danger';
                }
            }
            if ($amount != 0 && $amount1 ==0){
                $this->percent= 100;
                $this->status = 'no sales last year';
                $this->class = 'text-success';
            }
            if ($amount == 0 && $amount1 !=0){
                $this->percent= 0;
                $this->status = 'no sales this year';
                $this->class = 'text-danger';
            }
            if ($amount == 0 && $amount1 ==0){
                $this->percent= 0;
                $this->status = 'no sales last year and this year';
                $this->class = 'text-success';
            }
            $this->amount=$amount;
        }
        return view('livewire.admin.dashboard.revenuecard');
    }
}
