@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List of Store') }}</div>

                <div class="card-body">
                    <!-- <div class="container"> -->
                               
                    <form action="{{route('stores.search')}}" method="get">
                        @method('get')
                        <div class="row">
                            <div class="form-group row col-sm-4 col-lg-4 col-md-4">
                                <label for="search_text" class="col-sm-2 col-form-label">Search</label>
                                <div class="col-sm-10">
                                <input type="text" name="store_search" class="form-control form-control-sm col-sm-4" id="search_text" placeholder="Please Enter Search Text">
                                </div>
                            </div>
                    </form>

                            <div class="col-md-4 col-lg-4 col-sm-4">
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
                    <table class="table table-dark table-striped" style="margin-top: 20px; ">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Store Code</th>
                        <th scope="col">Store Name</th>
                        <th scope="col">Shop Level</th>
                        <th scope="col">Type</th>
                        <th scope="col">Price System</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        <?php $i=1; ?>
                        @foreach($stores as $store)
                        <tr>
                            <th>{{$i++}}</th>
                            <th>{{ $store->store_code }}</th>
                            <th>{{ $store->store_name }}</th>
                        
                        
                        @switch($store->shop_level)
                           @case(1) 
                            <th> {{ "Suspend Cooperation" }} </th>
                            @break
                           @case(2) 
                            <th> {{ "Close" }} </th>
                            @break
                           @default 
                           <th> {{ "In Cooperation" }} </th>
                        @endswitch
                        
                        @switch($store->type)
                           @case(2) 
                            <th> {{ "Suspend Cooperation"  }} </th>
                            @break
                           @case(0) 
                           <th>{{ "Close"  }} </th>
                            @break
                           @default 
                           <th>{{ "In Cooperation"  }} </th>
                        @endswitch

                        @switch($store->price_system)
                           @case(1) 
                           <th>{{ "Suspend Cooperation"  }} </th>
                            @break
                           @case(2) 
                           <th>{{ "Close"  }} </th>
                            @break
                           @default 
                           <th>{{ "In Cooperation"  }} </th>
                        @endswitch

                        
                        @switch($store->status)
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
                    {{ $stores->links(); }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection