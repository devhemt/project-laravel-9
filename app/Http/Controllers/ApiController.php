<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function apiproduct(){
        $product = Items::all();
        return json_decode($product);
    }
}
