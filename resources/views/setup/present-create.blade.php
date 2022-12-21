@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Create Form</h3>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ url('setup/present-save')}}"> @csrf
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="present_code" class="col-sm-2 col-form-label">Present Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="present_code" name="present_code">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="present_name" class="col-sm-2 col-form-label">Present Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="present_name" name="present_name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="draw_no" class="col-sm-2 col-form-label">Draw Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="draw_no" name="draw_no">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="p_image" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="p_image" onchange="loadPreview(this)" name="p_image">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="p_remark" class="col-sm-2 col-form-label">Remark</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" style="resize:none">Remark</textarea>
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
            </form>
        </div>
    </div>
</div>
<script>
    var loadPreview = function(event) {
        var preview = document.getElementById('preview_output');
        preview.src = URL.createObjectURL(event.files[0])
    }
</script>
@endsection