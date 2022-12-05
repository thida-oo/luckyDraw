<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $table='store';
    protected $fillable = ['store_code','store_name','type','distributor_id','price_system','shop_level','status','created_at','created_by'];
}
