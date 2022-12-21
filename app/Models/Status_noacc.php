<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_noacc extends Model
{
    use HasFactory;
    protected $table = 'status_noacc';
    protected $primaryKey = 'status_id';
    protected $fillable = ['invoice_id','status'];
}
