<?php

namespace App\Imports;

use App\Models\Stock;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Sale;
set_time_limit(99999);

class SaleImport implements ToModel, WithHeadingRow,WithBatchInserts,WithChunkReading
{

    private $distributor_array;
    private $area;
    private $products;
    private $store;

    public function __construct($distributor_array,$area,$products,$store)
    {
        $this->distributor_array = $distributor_array;
        $this->area = $area;
        $this->products = $products; 
        $this->store = $store;

    }

    public function model(array $row)
    {   
            $match_area = array_search($row['asm_area'],$this->area->toArray());
     
            //  Validate ASM area
            if(!isset($match_area)){
                echo $row['asm_area'].' is not found.'; die;
            }else{
                $asm_area = $row['asm_area'];
            }

            //  Validate Stores
            $match_store = in_array($row['sales_store_code'],$this->store->toArray());

            if(!isset($match_store)){
                echo $row['sales_store_code'].' is not found.'; die;
            }else{
                $stores = $row['sales_store_code'];
            }

            return new Sale([
                'imei_sn'=>$row['imei_1'],
                'imei_sn_2'=>$row['imei_2'],
                'box_id'=>$row['box_no'],
                'area_id'=>$match_area,
                'sku_id'=>$this->products[$row['sku_name']],
                'distributor_code'=>$this->distributor_array[$row['distributor_code']],
                'store_code'=>$stores,
                'verifier_id'=>$row['salespeople_employee_number'],
                'verification_time'=>$row['verification_time'],
                'registered_time'=>$row['registration_time'],
                'created_at'=>now()
            ]);
    }

        
     public function batchSize(): int
    {
        return 1000;
    }
    
    public function chunkSize(): int
    {
        return 1000;
    }
}
