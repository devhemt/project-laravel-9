<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_invoice_noacc extends Model
{
    use HasFactory;
    protected $table = 'detail_invoice_noacc';
    protected $primaryKey = 'dtliv_id';
    protected $fillable = ['itemsid','invoice_id','size','color','amount','price_one','cost_one'];
}
