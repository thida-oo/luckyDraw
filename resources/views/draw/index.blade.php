@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Let's Draw</h4>
        </div>
        <div class="card-body">
            <form class="form-controls" method="POST" action="{{ route('store') }}">
                @csrf
                    <div class="mb-3">
                        <label for="storeID" class="form-label">Store Code</label>
                        <input type="text" class="form-control" id="storeID" aria-describedby="storeID" name="store_id" required>
                        <div id="storeID" class="form-text">ဆိုင် Code သည် Leaf System ထဲမှ ဆိုင် Code နဲ့ အတူတူ ဖြစ်ရမည်</div>
                    </div>
                    <div class="mb-3">
                        <label for="imei_sn" class="form-label">IMEI</label>
                        <input type="text" class="form-control" id="imei_sn" name="imei_sn" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="drawButton">Draw</button>
            </form>
        </div>
    </div>
    <div class="modal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
               
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
<script>
    // var checkIMEILength = function(event) {
    //     var preview = document.getElementById('imei_sn').getAttribute();
    //     console.log(preview);
        
    // }
</script>

@endsection