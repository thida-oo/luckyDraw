<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(10);
        return view('setup/product',['products'=>$products]);
    }
    
    public function _productImport(Request $request)
    {
        $import_file = $request->file('file');
        if($import_file){
            try{
                Excel::import(new ProductImport, $import_file);
                return view('setup/import')->with('success', 'Data successfully imported');
            } catch(Exception $e){

               dd($e);
            }            
        }
    }
        public function productSearch(Request $request)
    {
        $product = new Product();
        $products=$product->_searchProducts($request->input('product_search'));
        return view('setup/product', ['products' => $products]);
    }
}
