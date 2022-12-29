<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
public $timestamps = false;
protected $table='stock';
protected $fillable=['imei_sn','imei_sn_2','store_code','distributor_code','region_id','warehouse_id','order_date','order_by','shipment_order_no','delivery_order_no','product_id'];

}
