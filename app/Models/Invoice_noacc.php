<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_noacc extends Model
{
    use HasFactory;
    protected $table = 'invoice_noacc';
    protected $primaryKey = 'invoice_id';
    protected $fillable = ['cusid','pay','payment','delivery'];
}
