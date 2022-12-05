@extends('layouts.app')

@section('content')
<style type="text/css">
  
</style>
<div class="container col-5">
  <form method="POST" enctype="multipart/form-data" action="{{ url('setup/distributor/import')}}">
  @csrf
  <div class="card">
    <div class="card-header">
      <span>Distributor Upload</span>
    </div>
    <div class="card-body">
     <div class="form-group">
      <label for="distributorImport">Distributor file input</label>
      <input type="file" name="file" class="form-control-file" id="distributorImport">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
  </div>

  </form>
</div>
@endsection