<?php

namespace App\Imports;

use App\Models\Distributor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use DB;
class DistributorImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        $superior_distributor = $row['upper_level_distributor']; 
        if($superior_distributor == 'BF Science & Technology Co.,Ltd.'){
            $s_data = 1;
        } else {
            $s_data = 0;
        }

        $d_type = $row['distributor_type'];
        if($d_type == 'FIRST_LEVEL_AGENT'){
            $type_data = 1;
        } elseif($d_type == 'SECOND_LEVEL_AGENT'){
            $type_data = 2;
        }else {
            $type_data = 3;
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
        }else{
            $price_data=0;
        }


        $status = $row['status'];
        if($status == 'Suspend Cooperation'){
            $status_data = 1;
        } elseif($status == 'Close'){
            $status_data = 2;
        }else{
            $status_data = 0;
        }

        // $table = DB::table('distributors')->where('distributor_code','=',$row['distributor_code'])->get();

        //if($type_data==3){

        return new Distributor([
            'distributor_code'     => $row['distributor_code'],
            'distributor_name'    => $row['distributor_name'], 
            'superior_distributor' =>  $s_data,
            'type'          => $type_data,
            'price_system' => $price_data,
            'status' => $status_data,
        ]);

    //}

        
    }
}
