@extends('layouts.app')

@section('content')
<form method="POST" enctype="multipart/form-data" action="{{ url('setup/import')}}">
@csrf
  <div class="form-group">
    <label for="distributorImport">Distributor file input</label>
    <input type="file" name="file" class="form-control-file" id="distributorImport">
    <button type="submit">Submit</button>
  </div>
</form>
@endsection