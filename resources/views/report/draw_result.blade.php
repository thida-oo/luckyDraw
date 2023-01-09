@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List of Lucky Draw Result') }}</div>

                <div class="card-body">
                    <!-- <div class="container"> -->
                        <?php
                            if(isset($_GET['search'])){
                                $search = $_GET['search'];
                            }else{
                                $search = '';
                            }

                            if(isset($_GET['startDate'])){
                                $startDate = $_GET['startDate'];
                            }else{
                                $startDate = null;
                            }

                            if(isset($_GET['endDate'])){
                                $endDate = $_GET['endDate'];
                            }else{
                                $endDate = null;
                            }
                        ?>
                               
                    <form action="{{route('search-lucky-draw-result')}}" method="get">
                        @method('get')
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="form-group row col-sm-4 col-lg-4 col-md-4">
                                    <label for="search_text" class="col-sm-2 col-form-label">Search</label>
                                    <div class="col-sm-8 col-lg-8 col-md-8">
                                    <input type="text" name="search" class="form-control form-control-sm col-sm-4" id="search_text" value="{{$search}}" placeholder="Please Enter Search Text" >
                                </div>
                            </div>
                            <div class="form-group row col-sm-4 col-lg-4 col-md-4">
                                    <label for="search_text" class="col-sm-3 col-lg-3 col-md-3 col-form-label">Start Date</label>
                                    <div class="col-sm-8 col-lg-8 col-md-8">
                                    <input type="date" name="startDate" value="<?php echo $startDate; ?>" class="form-control form-control-sm col-sm-4" >
                                </div>
                            </div>
                            <div class="form-group row col-sm-4 col-lg-4 col-md-4">
                                    <label for="search_text" class="col-sm-3 col-lg-3 col-md-3 col-form-label">End  Date</label>
                                    <div class="col-sm-8 col-lg-8 col-md-8">
                                    <input type="date" name="endDate" value="<?php echo $endDate; ?>" class="form-control form-control-sm col-sm-4" >
                                </div>
                            </div>
                        </div>
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
                         </form>

                      

                    <!-- </div> -->
                    <table class="table table-striped" style="margin-top: 20px; ">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">IMEI</th>
                        <th scope="col">Store Code</th>
                        <th scope="col">Present Name</th>
                        <th scope="col">Draw Staff</th>
                        <th scope="col">Draw Date</th>
                        </tr>
                    </thead>
                    <tbody>
                  
                        <?php $i=1; ?>
                    @if(isset($records))
                        @foreach ($records as $key=>$record)
                            <tr>
                                <td>{{ $loop->iteration + ($records->currentPage() - 1) * $records->perPage() }}</td>
                                <td>{{ $record->imei_sn }}</td>
                                <td>{{ $record->draw_store   }}</td>
                                <td>{{ $record->present_name }}</td>
                                <td>{{ $record->name }}</td>
                                <td>{{ date('l, F j, Y', strtotime($record->draw_date)) }}</td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach

                    @elseif(isset($search_records))
                    @foreach ($search_records as $key=>$record)
                            <tr>
                                <td>{{ $loop->iteration + ($search_records->currentPage() - 1) * $search_records->perPage() }}</td>
                                <td>{{ $record->imei_sn }}</td>
                                <td>{{ $record->draw_store   }}</td>
                                <td>{{ $record->present_name }}</td>
                                <td>{{ $record->name }}</td>
                                <td>{{ date('l, F j, Y', strtotime($record->draw_date)) }}</td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach

                    @endif
                    </tbody>
                    </table>
                @if(isset($records))
                  {{ $records->links()}}
                @elseif(isset($search_records))
                  {{ $search_records->links()}}
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection