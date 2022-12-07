<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Distributor extends Model
{
    use HasFactory;

    protected $fillable = ['distributor_code','distributor_name','superior_distributor', 'type', 'price_system', 'status'];

    public function _getDistributorInfoFromText($txt)
    {
        $result = DB::table('distributors')->where('distributor_name',$txt)->get();
        return $result;
    }
    public function _searchDistributor($searchTxt)
    {
        $result = DB::table('distributors');
                  $result->where(function($result) use ($searchTxt){
                  $result->orWhere('distributor_code', 'like', '%'.$searchTxt.'%');
                  $result->orWhere('distributor_name', 'like', '%'.$searchTxt.'%');
                })->get();
                  $data = $result->paginate(10);
                  return $data;
    }
}
