<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Smallnavadmin extends Component
{
//    check role and return notification
    protected $listeners = ['loadsmallnavadmin'];
    public $job, $profile;
    public function loadsmallnavadmin(){}

    public function render()
    {
        $userid = Auth::guard('user')->user()->user_id;
        $this->profile = DB::table('user')
            ->where('user_id', $userid)
            ->get();
        switch ($this->profile[0]->role){
            case "1":
                $this->job = "Director";
                break;
            case "2":
                $this->job = "Total Manager";
                break;
            case "3":
                $this->job = "Import Manager";
                break;
            case "4":
                $this->job = "Order Manager canceled";
                break;
            case "5":
                $this->job = "Order Manager noprocess";
                break;
            case "6":
                $this->job = "Order Manager confirmed";
                break;
            case "7":
                $this->job = "Order Manager packing";
                break;
            case "8":
                $this->job = "Order Manager success";
                break;
            case "9":
                $this->job = "Delivery Manager";
                break;
        }
        return view('livewire.admin.smallnavadmin');
    }
}
