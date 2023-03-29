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
                $search = '';
              }; 
              if(isset($_GET['status'])){
                $status = $_GET['status'];
            }else{
                $status = 2;
            }
              ?>
            <div class="card-body">
                <form class="row g-3" action="{{url('/setup/event-setting/search')}}" method="get">
                    <div class="col-auto">
                        <label for="searchText" class="visually-hidden">Search Text</label>
                        <input type="text" readonly class="form-control-plaintext" id="search" value="Search Text">
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
    <div class="container pt-2">
        <div class="card">
            <h4 class="card-header d-flex justify-content-between align-items-center">List of Event Setting
                <a href="{{ url('setup/event-setting-create') }}"><button type="button" class="btn btn-primary">Create</button></a>
            </h4>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Region</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($e_settings as $k=>$setting)
                        <tr>
                            <td>{{ $loop->iteration + ($e_settings->currentPage() - 1) * $e_settings->perPage() }}</td>
                            <td>{{ $setting->name }}</td>
                            <td class="align-middle">
                                {{$depts[$setting->region_id]}}
                           </td>
                            <td>
                                <?php echo date('d-m-Y',strtotime($setting->event_start_time)); ?>
                            </td>
                            <td>
                                <?php echo date('d-m-Y',strtotime($setting->event_end_time)); ?>
                            </td>

                            <td class="align-middle">
                                @if($setting->status==0)
                                <button type="button" class="btn btn-sm btn-outline-danger" disabled>Deactive</button>
                                @elseif($setting->status==1)
                              
                                  <button type="button" class="btn btn-sm btn-outline-primary" disabled>Active</button>
                                @endif
                            </td>
                            <td>
                            <a href="{{ url('setup/event-setting-overview/' .$setting->id) }}"><span class="material-symbols-outlined">overview</span>
                            <a href="{{ url('setup/event-setting-edit/' .$setting->id) }}"><span class="material-icons">edit</span>
                                @if($setting->status==0)
                             <a href="{{ url('setup/event-setting-delete/' .$setting->id) }}"><span class="material-icons">autorenew</span>
                                @elseif($setting->status==1)
                             <a href="{{ url('setup/event-setting-delete/' .$setting->id) }}"><span class="material-icons">delete</span>

                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $e_settings->links()}}
            </div>
        </div>
    </div>
</div>
@endsection