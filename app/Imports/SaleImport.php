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
use Exception;
set_time_limit(99999);

class SaleImport implements ToModel, WithHeadingRow,WithBatchInserts,WithChunkReading
{


    private $area;
    private $products;
    private $store;

    public function __construct($area,$products,$store)
    {

        $this->area = $area;
        $this->products = $products; 
        $this->store = $store;
    }

    public function model(array $row)
    {   
          try {
            $match_area = array_search($row['asm_area'],$this->area->toArray());
     
            //  Validate ASM area
            if($match_area==false){
                Alert::info("ASM Area '".$row['asm_area']."' has not found.")->persistent('Dismiss');
                $asm_area = null;
            }else{
                $asm_area = $row['asm_area'];
            }

            //  Validate Stores
            $match_store = in_array($row['sales_store_code'],$this->store->toArray());
           
            if($match_store==false){
                 Alert::info("Store code '".$row['sales_store_code']."' has not found.");
            }else{
                $stores = $row['sales_store_code'];
            }

            return new Sale([
                'imei_sn'=>$row['imei_1'],
                'imei_sn_2'=>$row['imei_2'],
                'box_id'=>$row['box_no'],
                'area_id'=>$match_area,
                'sku_id'=>$this->products[$row['sku_name']],
                'distributor_code'=>$row['distributor_code'],
                'store_code'=>$stores,
                'verifier_id'=>$row['salespeople_employee_number'],
                'verification_time'=>$row['verification_time'],
                'registered_time'=>$row['registration_time'],
                'created_at'=>now()
            ]);

            } catch (Exception $e) {
                Alert::info($e->getMessage())->persistent('Dismiss');
            }

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
