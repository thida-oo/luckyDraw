@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Create Form</h3>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ url('setup/kpi-setting-save')}}"> @csrf
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label for="present_code" class="col-sm-2 col-form-label">Staff Type</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="staff_type">
                                    <option>PG</option>
                                    <option>Sale</option>
                                    <option>Leader</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="present_name" class="col-sm-2 col-form-label">SKU Name</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="sku_name">
                                    @foreach($sku_lists as $sku)
                                    <option value="{{ $sku->id }}">{{ $sku->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="draw_no" class="col-sm-2 col-form-label">KPI Amount</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="kpi_amt" name="kpi_amt">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="p_image" class="col-sm-2 col-form-label">Started Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="started_date" class="form-control form-control-sm" id="started_date" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="p_image" class="col-sm-2 col-form-label">Ended Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="ended_date" class="form-control form-control-sm" id="ended_date" >
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mb-3 row">
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