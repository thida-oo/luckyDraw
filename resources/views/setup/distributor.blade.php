@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List of Distributor') }}</div>

                <div class="card-body">
                    <!-- <div class="container"> -->
                               
                    <form>
                        <div class="row">
                            <div class="form-group row mx-sm-3 mb-2">
                                <label for="search_text" class="col-sm-2 col-form-label">Search</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control col-sm-4" id="search_text" placeholder="Please Enter Search Text">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <div class="row">
                                <div class="col mb-1">
                                   <button type="submit" class="btn btn-primary">Search</button>
                                </div>  
                                <div class="col mb-1">
                                   <button type="submit" class="btn btn-primary">Cancel</button>
                                </div>                                
                                <div class="col mb-1">
                                    <button type="submit" class="btn btn-primary">Export</button>
                                </div>                                
                                <div class="col mb-1">  
                                    <!-- <a href=" {{ url('setup/distributorImport') }} " class="btn btn-primary">Import</a> -->
                                </div>
                             </div>
                            </div>

                    </form>
                    <!-- </div> -->
                    <table class="table table-dark table-striped" style="margin-top: 20px; ">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Distributor Code</th>
                        <th scope="col">Distributor Name</th>
                        <th scope="col">Superior Distributor</th>
                        <th scope="col">Type</th>
                        <th scope="col">Price System</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    

                        @foreach($distributors as $distributor)
                        <tr>
                            <th>{{ $distributor->distributor_code }}</th>
                            <th>{{ $distributor->distributor_code }}</th>
                            <th>{{ $distributor->distributor_name }}</th>
                        
                        
                        @switch($distributor->superior_distributor)
                           @case(1) 
                            <th> {{ "Suspend Cooperation" }} </th>
                            @break
                           @case(2) 
                            <th> {{ "Close" }} </th>
                            @break
                           @default 
                           <th> {{ "In Cooperation" }} </th>
                        @endswitch
                        
                        @switch($distributor->type)
                           @case(1) 
                            <th> {{ "Suspend Cooperation"  }} </th>
                            @break
                           @case(2) 
                           <th>{{ "Close"  }} </th>
                            @break
                           @default 
                           <th>{{ "In Cooperation"  }} </th>
                        @endswitch

                        @switch($distributor->price_system)
                           @case(1) 
                           <th>{{ "Suspend Cooperation"  }} </th>
                            @break
                           @case(2) 
                           <th>{{ "Close"  }} </th>
                            @break
                           @default 
                           <th>{{ "In Cooperation"  }} </th>
                        @endswitch

                        
                        @switch($distributor->status)
                           @case(1) 
                           <th>{{ "Suspend Cooperation"  }} </th>
                            @break
                           @case(2) 
                           <th>{{ "Close"  }} </th>
                            @break
                           @default 
                           <th>{{ "In Cooperation"  }} </th>
                        @endswitch

     
                        </tr>
                        @endforeach

                    </tbody>
                    </table>
                    {{ $distributors->links(); }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection