<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Store extends Model
{
    use HasFactory;
    protected $table='store';
    protected $fillable = ['store_code','store_name','type','distributor_id','price_system','shop_level','status','created_at','created_by'];

    public function _searchStores($searchTxt)
{
    $result = DB::table('store');
              $result->where(function($result) use ($searchTxt){
              $result->orWhere('store_code', 'like', '%'.$searchTxt.'%');
              $result->orWhere('store_name', 'like', '%'.$searchTxt.'%');
            })->get();
              $data = $result->paginate(10);
              return $data;
    }
}
