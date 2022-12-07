@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="mb-3 row">
                <label for="present_code" class="col-sm-2 col-form-label">Present Code</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="present_code">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="present_name" class="col-sm-2 col-form-label">Present Name</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="present_name">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="draw_no" class="col-sm-2 col-form-label">Draw Number</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="draw_no">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="p_image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                <input type="file" class="form-control" id="p_image" onchange="loadPreview(this)">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <img src="{{ asset('image/default.png') }}" id="preview_output" class="img-fluid rounded-circle" alt="default" width="450">
            </div>
        </div>
    </div>
    
    
    <div class="mb-3 row">     
        <label for="p_image" class="col-sm-2 col-form-label"></label>   
        <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-primary">Reset</button>
        </div>
    </div>

    <!-- for present ID Lists -->
    <div>
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

<script>
    var loadPreview = function(event){
        var preview = document.getElementById('preview_output');
        preview.src =  URL.createObjectURL(event.files[0])
    }
</script>
@endsection