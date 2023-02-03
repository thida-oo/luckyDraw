<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
        use HasFactory;
    public $timestamps = false;
    protected $table='sellouts';
    protected $fillable=['imei_sn','imei_sn_2','box_id','area_id','sku_id','distributor_code','store_code','verifier_id','verification_time','registered_time'];
}
