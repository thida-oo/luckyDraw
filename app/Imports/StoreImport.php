<?php

namespace App\Imports;

use App\Models\Store;
use App\Models\Distributor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Facades\Auth;
use DB;
class StoreImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // echo '<pre>',print_r($row,1),'</pre>';
        $distributor = new Distributor();
        $distributor_data = $distributor->_getDistributorInfoFromText($row['affiliated_distributor']);

        if(count($distributor_data) == 0){
            $distributor_id=null;
        }else{
            $distributor_id=$distributor_data[0]->distributor_code;
        }

        $price_system = $row['price_system'];
        if($price_system == '批发价'){ // Retail Price(with Tax)
            $price_data = 3; 
        }  elseif($price_system == '批发价（不含税）'){ // Retail Price(No Tax)
            $price_data = 4;
        }elseif($price_system == '代理价'){ //Agent Price
            $price_data = 2;
        }elseif($price_system == '采购价'){ //Purchase Price
            $price_data = 1;
        }


        $status = $row['status'];
        if($status == 'Suspend Cooperation'){
            $status_data = 1;
        } elseif($status == 'Close'){
            $status_data = 2;
        }else{
            $status_data = 0;
        }

        $type = $row['shop_type'];
        if($type == 'Composite shop'){
            $type_data = 1;
        } elseif($type == 'Operator Store'){
            $type_data = 2;
        }

        $level = $row['shop_level'];
        if($level == ''){
            $level=0;
        }else{
            $level=$row['shop_level'];
        }
    
    $table = DB::table('store')->where('store_code','=',$row['store_code'])->get();
    
    if(count($table)<1){        
        return new Store([
                    'store_code'=>$row['store_code'],
                    'store_name'=>$row['store_name'],
                    'type'=>$type_data,
                    'distributor_id'=> $distributor_id,
                    'customer_id'=> 1,
                    'price_system'=>$price_data ,
                    // 'shop_level'=>$level,
                    'status'=>$status_data,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'created_by'=>Auth::user()->id,
                
                ]);
        }

        
    }
}
