@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card  col-8">
			<div class="card-header">
					<h5>Title</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-2 col-lg-2 col-md-2">
						Distributors
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<input type="file"  class="form-control form-control-sm" required />
					</div>
					<div class="col-sm-4 col-lg-4 col-md-4">
						<button class="btn  btn-primary btn-sm">Submit</button>
					</div>
					
				</div>
				<form method="POST" enctype="multipart/form-data" action="{{route('store-import')}}"  >
					@csrf
					@method('post')
				<div class="row mt-4">
					<div class="col-sm-2 col-lg-2 col-md-2">
						Stores
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<input type="file"  name="file" class="form-control form-control-sm" required />
					</div>
					<div class="col-sm-4 col-lg-4 col-md-4">
						<button class="btn  btn-primary btn-sm">Submit</button>
					</div>
				</div>
				</form>
				<div class="row mt-4">
					<div class="col-sm-2 col-lg-2 col-md-2">
						Products
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<input type="file" class="form-control form-control-sm" required />
					</div>
					<div class="col-sm-4 col-lg-4 col-md-4">
						<button class="btn  btn-primary btn-sm">Submit</button>
					</div>
					
				</div>
			</div>
			
		</div>
		
	</div>
@endsection