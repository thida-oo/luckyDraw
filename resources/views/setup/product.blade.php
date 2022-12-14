@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4 col-lg-4 col-md-4">

			<div class="card">
				<div class="card-header">
					<span>Product List</span>
				</div>

				@if(!empty($edit))
				<form action="{{route('product-store')}}" method="post">
				@csrf
				@method('POST')
			<div class="card-body">
                <div class="form-group row col-sm-12 col-lg-12 col-md-12 p-2">
	                    <label for="search_text" class="col-sm-4 col-lg-4 col-md-4 col-form-label">Code</label>
	                    <div class="col-sm-8">
	                    <input type="text" name="p_code" class="form-control form-control-sm col-sm-4" value="{{$edit->p_code}}" placeholder="Please Enter Code">
                       @error('p_code')
	                        <small class="text-danger text-sm">
	                        	 {{$message}}
	                        </small>
                       @enderror
	                    </div>
	                </div>
	        <div class="form-group row col-sm-12 col-lg-12 col-md-12 p-2">
	                    <label for="search_text" class="col-sm-4 col-lg-4 col-md-4">Product Name</label>
	                    <div class="col-sm-8">
	                    <input type="text" name="p_name" class="form-control form-control-sm col-sm-4" value="{{$edit->p_name}}" placeholder="Please Enter Product Name">
	                    @error('p_name')
	                        <small class="text-danger text-sm">
	                        	 {{$message}}
	                        </small>
                       @enderror
	                    </div>
	                </div>
	              <div class="col-sm-12 col-lg-12 col-md-12 text-center p-2">
	              	<button class="btn btn-sm btn-primary">Update</button>
	              	<a class="btn btn-sm btn-danger" href="{{route('product.index')}}">Back</a>
	              </div>
                </div>
        </form>
        @else
        <form action="{{route('product-store')}}" method="post">
				@csrf
				@method('POST')
			<div class="card-body">
                <div class="form-group row col-sm-12 col-lg-12 col-md-12 p-2">
	                    <label for="search_text" class="col-sm-4 col-lg-4 col-md-4 col-form-label">Code</label>
	                    <div class="col-sm-8">
	                    <input type="text" name="p_code" class="form-control form-control-sm col-sm-4" value="{{old('p_code')}}" placeholder="Please Enter Code">
                       @error('p_code')
	                        <small class="text-danger text-sm">
	                        	 {{$message}}
	                        </small>
                       @enderror
	                    </div>
	                </div>
	        <div class="form-group row col-sm-12 col-lg-12 col-md-12 p-2">
	                    <label for="search_text" class="col-sm-4 col-lg-4 col-md-4">Product Name</label>
	                    <div class="col-sm-8">
	                    <input type="text" name="p_name" value="{{old('p_name')}}" class="form-control form-control-sm col-sm-4" placeholder="Please Enter Product Name">
	                    @error('p_name')
	                        <small class="text-danger text-sm">
	                        	 {{$message}}
	                        </small>
                       @enderror
	                    </div>
	                </div>
	              <div class="col-sm-12 col-lg-12 col-md-12 text-center p-2">
	              	<button class="btn btn-sm btn-primary">Submit</button>
	              	<button class="btn btn-sm btn-danger">Clear</button>
	              </div>
                </div>
        </form>
        @endif
            </div>
            </div>
		<div class="col-sm-8 col-lg-8 col-md-8">
			<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Search
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
   <div class="row">
   	<?php $product_search=$_GET['product_search']; ?>
  		 	<form action="{{url('setup/product/search')}}" method="get">
  		 		@csrf
  		 		@method('get')
                <div class="form-group row col-sm-12 col-lg-12 col-md-12 p-2">
	                    <label for="search_text" class="col-sm-2 col-lg-2 col-md-2 col-form-label">Search with text</label>
	                    <div class="col-sm-4 col-md-4 col-lg-4">
	                    <input type="text" name="product_search" class="form-control form-control-sm col-sm-4" value="{{$product_search}}"  placeholder="Please Search Text">
	                    </div>
	                   <div class="col-sm-4 col-lg-4 col-md-4">
			                    <button class="btn btn-primary btn-sm">Search</button>
		               </div>
	                </div>
	        </form>
   </div>
      </div>
    </div>
  </div>
</div>
				<table class="table table-dark table-striped" style="margin-top: 20px; ">
					<thead>
                        <tr>
	                        <th scope="col">#</th>
	                        <th scope="col">Product Code</th>
	                        <th scope="col">Product Name</th>
	                        <th scope="col">Created At</th>
	                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $i=1; ?>
                    	@foreach($products as $product)
                    	<tr>
                    		<td>{{$i++}}</td>
                    		<td>{{$product->p_code}}</td>
                    		<td>{{$product->p_name}}</td>
                    		<td>{{$product->created_at}}</td>
                    		<td>
                    			<div class="row">
                    				<div class="col">
                    					<a href="{{url('setup/product/edit/'.$product->id)}}">
                     						<i class="fa fa-pencil" aria-hidden="true"></i>
                    					</a>
                    				</div>
                    				<div class="col">
                    					<a href="{{url('setup/product/delete/'.$product->id)}}">
                    						<i class="fa fa-trash" aria-hidden="true"></i> 	
                    					</a>
                    				</div>
                    			</div>
                    		</td>
                    	</tr>
                    	@endforeach
                    </tbody>
				</table>
				   {{ $products->links(); }}
		</div>
	</div>
</div>
<style type="text/css">
	a{
		text-decoration: none;
		color: white;
	}
</style>
@endsection