<?php

namespace App\Imports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Facades\Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class StockImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {   
        DB::table('stock')->where('imei_sn',$row['ime'])->delete();
        
        if( $row['shipping_warehouse'] != "HQ_MDY"){
            // Store code get from store table $row['orderdepotname'] 
            $store_code = DB::table('store')->where('store_name','like','%'.$row['orderdepotname'].'%')->get();
       
            // Distributor code get from distributor table $row['distributor']
            $distributor_code = DB::table('distributors')->where('distributor_name','like','%'.$row['purchasing_channel'].'%')->get();
            
             if($store_code->count() > 0 || $distributor_code->count() > 0){
            Alert::info("IMEI'".$row['ime']."' has error.Please check store'".$row['orderdepotname']."' and distributor '".$row['purchasing_channel']." exist or not'.");
        }

            // Product id get from product table $row['productname']
            $product_id = DB::table('products')->where('p_name','like','%'.$row['productname'].'%')->get();
            if($product_id->count() > 0){
                Alert::info("Prouct '".$row['productname']."does not exist.'");
            }
            // Warehouse id get from warehouse table
            $warehouse_id = DB::table('warehouses')->where('name','like','%'.$row['shipping_warehouse'].'%')->get();
           
            return new Stock([
                'imei_sn' => $row['ime'],
                'imei_sn_2' => $row['ime2'],
                'store_code' => count($store_code) == 0 ? null : $store_code[0]->store_code,
                'distributor_code' =>count($distributor_code) == 0 ? null : $distributor_code[0]->distributor_code,            
                // 'region_id' => $row['product_item_name'],
                'warehouse_id' =>count($warehouse_id) == 0 ? 0 : $warehouse_id[0]->id,
                'order_date' =>$row['orderdate'],
                'order_by' =>1,
                'shipment_order_no' =>$row['shipment_no'],
                'delivery_order_no' =>$row['saleorderno'],
                'product_id' =>count($product_id) == 0 ? 0 : $product_id[0]->id,
            ]);
        }


        
     }
}
