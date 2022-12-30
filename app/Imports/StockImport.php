<?php

namespace App\Imports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Facades\Auth;
use DB;
class StockImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {   
        DB::table('stock')->where('imei_sn',$row['ime'])->delete();
        // Store code get from store table $row['orderdepotname']
        $store_code = DB::table('store')->where('store_name','like','%'.$row['orderdepotname'].'%')->get();
        // echo '<pre>',print_r($row,1),'</pre>';
        // echo "<br/>";
        // Distributor code get from distributor table $row['distributor']
        $distributor_code = DB::table('distributors')->where('distributor_name','like','%'.$row['purchasing_channel'].'%')->get();
        // Product id get from product table $row['productname']
        $product_id = DB::table('products')->where('p_code','like','%'.$row['productname'].'%')->get();
        // Warehouse id get from warehouse table
        $warehouse_id = DB::table('warehouses')->where('name','like','%'.$row['shipping_warehouse'].'%')->get();
        return new Stock([
            'imei_sn' => $row['ime'],
            'imei_sn_2' => $row['ime2'],
            'store_code' => $store_code[0]->store_code,
            'distributor_code' =>$distributor_code[0]->distributor_code,            
            // 'region_id' => $row['product_item_name'],
            'warehouse_id' =>$warehouse_id[0]->id,
            'order_date' =>$row['orderdate'],
            'order_by' =>$row['orderoperatorname'],
            'shipment_order_no' =>$row['shipment_no'],
            'delivery_order_no' =>$row['saleorderno'],
            'product_id' =>$product_id[0]->id,
        ]);
     }
}
