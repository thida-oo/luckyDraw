@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{url('/css/select2.css')}}" />
<link rel="stylesheet" href="{{url('/css/select2-bootstrap4.min.css')}}">
<link href="{{url('/css/select2-bootstrap4.min.css')}}" rel="stylesheet">
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Event Settings Overview</h4>
        </div>
        <div class="card-body">
            <form action="{{route('event-setting-update')}}" method="post">
                @csrf
                @method('POST')
                <input type="hidden" name="event_id" value="{{$res[0]->event_id}}">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="mb-3 row col-sm-6 col-md-6 col-md-lg-6 text-right">
                            <label for="present_code" class="col-sm-3 col-md-3 col-lg-3 col-form-label ml-4">Name</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <input type="text" name="name" class="form-control form-control-sm" disabled value="{{$res[0]->name}}" id="present_code">
                            </div>
                        </div>
                        <?php 
                        $start_time = strtotime($res[0]->event_start_time);
                        $end_time = strtotime($res[0]->event_end_time);
                         ?>
                        <div class="mb-3 row col-sm-6 col-md-6 col-md-lg-6">
                            <label for="present_name" class="col-sm-3 col-md-3 col-lg-3 col-form-label">Started Time</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <input type="date" name="start_time" class="form-control form-control-sm" id="present_name" value="{{date('Y-m-d',$start_time)}}" disabled>
                            </div>
                        </div>

                        <div class="mb-3 row col-sm-6 col-md-6 col-md-lg-6 ">
                            <label class="col-sm-3 col-md-3 col-lg-3 col-form-label ml-4">Products</label>
                            <div class="col-sm-9 col-md-9 col-lg-9 bg-light">
                             <select disabled multiple data-placeholder="Choose Product" class="form-control form-control-sm bg-light" data-allow-clear="1" name="product[]">
                                    @foreach($products as $product)
                                        @foreach($productID as $pro)
                                            @if($pro == $product->id)
                                            <option value="{{$product->id}}" selected>{{$product->p_name}}</option>
                                            @else
                                            <option value="{{$product->id}}">{{$product->p_name}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row col-sm-6 col-md-6 col-md-lg-6">
                            <label for="draw_no" class="col-sm-3 col-md-3 col-lg-3 col-form-label">Ended Time</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <input type="date" name="end_time" class="form-control form-control-sm" value="{{date('Y-m-d',$end_time)}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- for present ID Lists -->
                <div>
                    <table class="table table-bordered" id="myTable" >
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Present Code</th>
                                <th>Present Name</th>
                                <th>Draw Number</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- get Data from Present -->
                            @foreach($res as $pList)
                     
                            <tr>
                                <td>{{ $pList->id }}</td>
                                <td>{{ $pList->present_code }}</td>
                                <td>{{ $pList->present_name }}</td>
                                   
                                <td>
                                  {{$pList->present_prob}}{{ "%" }}
                                </td>

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
<script>
 $(document).ready(function () {
       
       $("#myTable").on('input', '.percentage', function () {
          var calculated_total_sum = 0;
        
          $("#myTable .percentage").each(function () {
              var get_textbox_value = $(this).val();
              if ($.isNumeric(get_textbox_value)) {
                 calculated_total_sum += parseFloat(get_textbox_value);
                 }                  
               });
                //  $(".total").html(calculated_total_sum);
                if(calculated_total_sum > 100){
                    $('#btn_submit').attr('disabled',true);
                    alert('Percentage greater than 100%.')
                }else{
                    $('#btn_submit').attr('disabled',false);

                }
                if(calculated_total_sum > 100){
                    alert("No More Hundred");
                }
                console.log(calculated_total_sum)
          });
     });
</script>
<script type="text/javascript">
    $('select').select2({
        theme: 'bootstrap4',
    });
</script>

@endsection