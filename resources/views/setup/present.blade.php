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
                  <div class="col-3">
                  <select class="form-control w-100" name="status">
                      <option value="2" @if($status==2) {{'selected'}} @endif>All</option>
                      <option value="1" @if($status==1) {{'selected'}} @endif>Active</option>
                      <option value="0" @if($status==0) {{'selected'}} @endif>Deactive</option>
                  </select>
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
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- get Data from Present -->
                        @foreach($presents as $pList)
                        <tr>
                            <td>{{ $pList->id }}</td>
                            <td>{{ $pList->present_code }}</td>
                            <td>{{ $pList->present_name }}</td>
                            <td>{{ $pList->present_code }}</td>
                            <td>
                                <img src="{{ asset('image/presentsImage/'. $pList->image) }}" alt="default" width="100px;" />
                            </td>
                            <td class="text-center align-middle">
                                @if($pList->status==0)
                                <button type="button" class="btn btn-sm btn-outline-danger" disabled>Deactive</button>
                                @elseif($pList->status==1)
                              
                                  <button type="button" class="btn btn-sm btn-outline-primary" disabled>Active</button>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('setup/present-edit/' .$pList->id) }}"><span class="material-icons">edit</span></a>
                                @if($pList->status==1)
                                <a href="{{ url('setup/present-delete/' .$pList->id) }}"><span class="material-icons" style="padding-left: 3.5%;">delete</span>
                                </a>
                                @elseif($pList->status==0)
                                <a href="{{ url('setup/present-delete/' .$pList->id) }}"><span class="material-icons" style="padding-left: 3.5%;">autorenew</span>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
                <div class="col-sm-12 col-lg-12 col-md-12 ">
                    {{ $presents->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection