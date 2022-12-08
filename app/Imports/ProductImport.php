<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Facades\Auth;
use DB;
class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new product([
            'p_code' => $row['code'],
            'p_name' => $row['product_item_name'],
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' =>Auth::user()->id,
        ]);
     }
}
