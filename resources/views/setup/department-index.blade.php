@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row">
	<div class="col-sm-4 col-lg-4 col-md-4">
			<div class="card">
				<div class="card-header">
					Sync
				</div>
				<form action="{{url('setup/department/get')}}" method="get">
				<div class="col-md-8 mt-2">
					<div class="form-group row col-sm-12 col-lg-12 col-md-12 ml-2">
                    <label for="search_text" class="col-sm-4 col-lg-4 col-md-4 col-form-label px-4">Parent Id</label>
                    <div class="col-sm-8 row">
                    <input type="text" name="parent_id" class="form-control form-control-sm col-sm-4" placeholder="Please Enter department id">
                    <button class="btn btn-primary btn-sm mt-2 mb-2">Sync</button>
                       </div>
                     </div>
				</div>
				</form>
			</div>
		</div>
        <div class="col-md-8 col-lg-8 col-sm-8">
            	<div class="card">
                <div class="card-header">{{ __('List of Department') }}</div>

                <div class="card-body">
                    <!-- <div class="container"> -->
                               <?php 
                               if(isset($_GET['search'])){
                               $search=$_GET['search'];
                               }else{
                               	$search = null;
                               }
                                ?>
                    <form action="{{url('setup/department/search')}}" method="get">
                        @method('get')
                        <div class="row">
                            <div class="form-group row col-sm-6 col-lg-6 col-md-6">
                                <label for="search_text" class="col-sm-2 col-form-label">Search</label>
                                <div class="col-sm-10">
                                <input type="text" name="search" class="form-control form-control-sm col-sm-4" id="search_text" value="<?php echo $search; ?>" placeholder="Please Enter Search Text">
                                </div>
                            </div>
                    </form>

                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class="row no-gutters">
                                <div class="col-sm-2 col-lg-2 col-md-2 mb-1">
                                   <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                </div>  
                                <div class="col-sm-2 col-lg-2 col-md-2  mb-1">
                                   <button type="submit" class="btn btn-primary btn-sm">Cancel</button>
                                </div>                                
                                <div class="col-sm-2 col-lg-2 col-md-2  mb-1">
                                    <button type="submit" class="btn btn-primary btn-sm">Export</button>
                                </div>                                
                                <div class="col mb-1">  
                                    <!-- <a href=" {{ url('setup/distributorImport') }} " class="btn btn-primary">Import</a> -->
                                </div>
                             </div>
                            </div>

                    <!-- </div> -->
                    <table class="table table-striped" style="margin-top: 20px; ">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Parent Id</th>
                        <th scope="col">Department Id</th>
                        <th scope="col">Department Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($res as $val)
                    <tr>
                    	<td>{{ $loop->iteration + ($res->currentPage() - 1) * $res->perPage() }}</td>
                    	<td>{{$val->parent_id}}</td>
                    	<td>{{$val->dept_id}}</td>
                    	<td>{{$val->dept_name}}</td>
                    	<td>{{$val->created_at}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                 {{ $res->links(); }}
            	</div>
        </div>
    </div>
</div>
@endsection