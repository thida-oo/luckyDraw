@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List of Distributor') }}</div>

                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <div class="mb-3 ">
                                    <label for="dCode" class="form-label">Distributor Code</label>
                                    <input type="text" class="form-control" id="dCode">
                                </div>
                                <div class="mb-3 ">
                                    <label for="dName" class="form-label">Distributor Name</label>
                                    <input type="text" class="form-control" id="dName">
                                </div>
                                <div class="mb-3  form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <div class="mb-3">
                                    <label for="dCode" class="form-label">Distributor Code</label>
                                    <input type="text" class="form-control" id="dCode">
                                </div>
                                <div class="mb-3">
                                    <label for="dName" class="form-label">Distributor Name</label>
                                    <input type="text" class="form-control" id="dName">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <div class="mb-3 ">
                                    <label for="dCode" class="form-label">Distributor Code</label>
                                    <input type="text" class="form-control" id="dCode">
                                </div>
                                <div class="mb-3 ">
                                    <label for="dName" class="form-label">Distributor Name</label>
                                    <input type="text" class="form-control" id="dName">
                                </div>
                                <div class="mb-3  form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4">
                                <div class="row">
                                <div class="col">
                                   <button type="submit" class="btn btn-primary">Search</button>
                                </div>  
                                <div class="col">
                                   <button type="submit" class="btn btn-primary">Cancel</button>
                                </div>                                
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Export</button>
                                </div>                                
                                <div class="col">
                                    <a href=" {{ url('setup/distributorImport') }} " class="btn btn-primary">Import</a>
                                </div>
                             </div>
                            </div>
                        </div>
                        
                        
                        </form>
                    </form>
                    <!-- </div> -->
                    <table class="table table-dark table-striped" style="margin-top: 20px; ">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Distributor Code</th>
                        <th scope="col">Distributor Name</th>
                        <th scope="col">Superior Distributor</th>
                        <th scope="col">Type</th>
                        <th scope="col">Price System</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection