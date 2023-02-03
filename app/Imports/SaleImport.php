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

    public function __construct($distributor_array)
    {
        $this->distributor_array = $distributor_array;
    }

    public function model(array $row)
    {   
            return new Sale([
                'imei_sn'=>$row['imei_1'],
                'imei_sn_2'=>$row['imei_2'],
                'box_id'=>$row['box_no'],
                'area_id'=>1,
                'sku_id'=>1,
                'distributor_code'=>$this->distributor_array[$row['distributor_code']],
                'store_code'=>$row['sales_store_code'],
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
