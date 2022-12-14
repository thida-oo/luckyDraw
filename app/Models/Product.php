<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model
{
    use HasFactory;
    protected $fillable=['p_code','p_name','created_time','created_by','updated_at','updated_by'];

    public function _searchProducts($searchTxt)
    {
       $result = DB::table('products');
              $result->where(function($result) use ($searchTxt){
              $result->orWhere('p_code', 'like', '%'.$searchTxt.'%');
              $result->orWhere('p_name', 'like', '%'.$searchTxt.'%');
            })->get();
              $data = $result->paginate(10);
              return $data;
    }

}
