<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    private $fact;

    protected $table = 'items';
    protected $primaryKey = 'prd_id';
    protected $fillable = ['demoimage','name','description','price','tag','brand','provided'];

    public function test(){
        return $this->fact;
    }
}
