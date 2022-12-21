@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
    <div class="card">
        <div class="card-header">
            <h4><span class="badge"> Search </span></h4>
        </div>
        <div class="card-body">
            <form class="row g-3">
                <div class="col-auto">
                    <label for="searchText" class="visually-hidden">Search Text</label>
                    <input type="text" readonly class="form-control-plaintext" id="searchText" value="Search Text">
                </div>
                <div class="col-auto">
                    <label for="searchBox" class="visually-hidden">Search</label>
                    <input type="text" class="form-control" id="searchBox" placeholder="Please enter search text here">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Search</button>
                </div>
            </form>
        </div>
    </div>
    </div>



    <!-- for present ID Lists -->
    <div class="container pt-2">
        <div class="card">
    
            <h4 class="card-header d-flex justify-content-between align-items-center">Present Lists
                <a href="{{ url('setup/present-create') }}"><button type="button" class="btn btn-primary">Create</button></a>
            </h4>
                
            <!-- </div> -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Present Code</th>
                            <th>Present Name</th>
                            <th>Draw Number</th>
                            <th>Status</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- get Data from Present -->
                        @foreach($presents as $pList)
                        <tr>
                            <th>{{ $pList->id }}</th>
                            <th>{{ $pList->present_code }}</th>
                            <th>{{ $pList->present_name }}</th>
                            <th>{{ $pList->present_code }}</th>
                            <th><input type="checkbox"> </th>
                            <th><img src="{{ asset('image/presentsImage/'. $pList->image) }}" class="img-fluid" alt="default" width="50" height="80"></th>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection