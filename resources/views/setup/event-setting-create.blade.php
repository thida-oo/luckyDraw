@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{url('/css/select2.css')}}" />
<link rel="stylesheet" href="{{url('/css/select2-bootstrap4.min.css')}}">
<link href="{{url('/css/select2-bootstrap4.min.css')}}" rel="stylesheet">
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Create Event Settings</h4>
        </div>
        <div class="card-body">
            <form action="{{route('event-setting-store')}}" method="post">
                @csrf
                @method('POST')
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="mb-3 row col-sm-6 col-md-6 col-md-lg-6 text-right">
                            <label for="present_code" class="col-sm-3 col-md-3 col-lg-3 col-form-label ml-4">Name</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <input type="text" name="name" class="form-control form-control-sm" id="present_code">
                            </div>
                        </div>

                        <div class="mb-3 row col-sm-6 col-md-6 col-md-lg-6">
                            <label for="present_name" class="col-sm-3 col-md-3 col-lg-3 col-form-label">Started Time</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <input type="date" name="start_time" class="form-control form-control-sm" id="present_name" required>
                            </div>
                        </div>

                        <div class="mb-3 row col-sm-6 col-md-6 col-md-lg-6 ">
                            <label class="col-sm-3 col-md-3 col-lg-3 col-form-label ml-4">Products</label>
                            <div class="col-sm-9 col-md-9 col-lg-9 bg-light">
                                <select multiple data-placeholder="Choose Product" class="form-control form-control-sm bg-light" data-allow-clear="1" name="product[]">
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->p_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row col-sm-6 col-md-6 col-md-lg-6">
                            <label for="draw_no" class="col-sm-3 col-md-3 col-lg-3 col-form-label">Ended Time</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <input type="date" name="end_time" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="p_image" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        <button type="reset" class="btn btn-sm btn-primary">Reset</button>
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
                            @foreach($present_lists as $pList)
                            <tr>
                                <td>{{ $pList->id }}</td>
                                <td>{{ $pList->present_code }}</td>
                                <td>{{ $pList->present_name }}</td>
                                <td>
                                    <input type="text" name="draw_probability[]" value="{{$pList->present_prob}}">{{ "%" }}
                                </td>
                                <td><input type="checkbox" name="present_id[]" value="{{$pList->id}}"> </td>
                                <td>
                                    <img src="{{ asset('image/presentsImage/'. $pList->image) }}" class="img-fluid" alt="default" width="50" height="80">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>

</div>
<script src="{{url('/js/jquery3.5.1.js')}}"></script>
<script src="{{url('/js/bootstrap.min.js')}}"></script>
<script src="{{url('/js/select.min.js')}}"></script>
<script type="text/javascript">
    $('select').select2({
        theme: 'bootstrap4',
    });
</script>
@endsection