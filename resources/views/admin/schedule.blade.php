@extends('layouts.admin')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Schedule</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <form>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Mountain Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Check In</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="inputPassword3">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Quota Climbers</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputPassword3">
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">add new data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
