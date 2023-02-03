@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
    <div class="card">
        <div class="card-header">
            <h4><span class="badge"> Search </span></h4>
        </div>
        <?php 
            if(isset($_GET['search'])){
                $search = $_GET['search'];
            }else{
                $search = null;
            }

            if(isset($_GET['status'])){
                $status = $_GET['status'];
            }else{
                $status = 2;
            }
         ?>
        <div class="card-body">
            <form class="row g-3" action="{{route('present-search')}}" method="get">
                <div class="col-auto">
                    <label for="searchText" class="visually-hidden">Search Text</label>
                    <input type="text" readonly class="form-control-plaintext" id="searchText" value="Search Text">

                </div>
                <div class="col-auto">
                    <label for="searchBox" class="visually-hidden">Search</label>
                    <input type="text" class="form-control" value="{{$search}}" name="search" id="searchBox" placeholder="Please enter search text here">
                </div>
                  
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Search</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <div class="container pt-2">
        <div class="card">
    
            <h4 class="card-header d-flex justify-content-between align-items-center">KPI Setting Lists
                <a href="{{ url('setup/kpi-setting-create') }}"><button type="button" class="btn btn-primary">Create</button></a>
            </h4>
                
            <!-- </div> -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Staff Type</th> 
                            <th>SKU Name</th>                                                       
                            <th>KPI Amount</th>
                            <th>Started Date</th>
                            <th>Ended Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- get Data from KPI -->
                        @foreach($kpi_lists as $kpi)
                        <tr>
                            <td class="align-middle">{{ $kpi->id }}</td>
                            <td class="align-middle">{{ $kpi->staff_type }}</td>
                            <td class="align-middle">{{ $kpi->sku_id }}</td>
                            <td class="align-middle">{{ $kpi->amount }}</td>
                            <td class="align-middle">{{ $kpi->started_date }}</td>
                            <td class="align-middle">{{ $kpi->ended_date }}</td>
                            <td class="align-middle">{{ $kpi->started_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-sm-12 col-lg-12 col-md-12 ">
                    {{ $kpi_lists->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection