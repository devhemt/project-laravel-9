<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;

    protected $table = 'Properties';
    protected $primaryKey = 'id';
    protected $fillable = ['itemsid','size','color','batch','amount'];
}
