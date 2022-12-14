<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\storeProduct;
use App\Http\Requests\updateProduct;
use App\Models\Product;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use DB;
class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('id','desc')->paginate(10);
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
    public function productStore(storeProduct $request)
    {
        Product::create([
            'p_code'=>$request->input('p_code'),
            'p_name'=>$request->input('p_name'),
            'type'=>1,
            'created_at'=>date('Y-m-d H:i:s'),
            'created_by'=>Auth::user()->id,
        ]);
        return redirect()->route('product.index');
    }
    public function edit($id)
    {
        $products = Product::orderBy('id','desc')->paginate(10);
        $edit = Product::find($id);
        return view('setup/product',['products'=>$products,'edit'=>$edit]);

    }
    public function update(updateProduct $request,$id)
    {
        $product = Product::find($id);
        $product->p_code=$request->input('p_code');
        $product->p_name=$request->input('p_name');
        $product->updated_at=date("Y-m-d H:i:s");
        $product->updated_by=Auth::user()->id;
        $product->save();
        return redirect()->route('product.index');
    }
    public function delete($id)
    {
        $product = Product::find($id)->delete();
        return redirect()->route('product.index');
    }

}
