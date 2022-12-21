<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_noacc extends Model
{
    use HasFactory;
    protected $table = 'customer_noacc';
    protected $primaryKey = 'cus_id';
    protected $fillable = ['name','sessionid','email','phone','address'];
}
