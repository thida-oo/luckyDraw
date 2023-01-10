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
              }; ?>
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
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($e_settings as $k=>$setting)
                        <tr>
                            <td>{{ $loop->iteration + ($e_settings->currentPage() - 1) * $e_settings->perPage() }}</td>
                            <td>{{ $setting->name}}</td>
                            <td>{{ $setting->event_start_time}}</td>
                            <td>{{ $setting->event_end_time}}</td>
                            <td>
                            <a href="{{ url('setup/event-setting-overview/' .$setting->id) }}"><span class="material-symbols-outlined">overview</span>
                            <a href="{{ url('setup/event-setting-edit/' .$setting->id) }}"><span class="material-icons">edit</span>
                            <a href="{{ url('setup/event-setting-delete/' .$setting->id) }}"><span class="material-icons">delete</span>
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