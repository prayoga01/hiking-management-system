@extends('layouts.admin')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Mountain Able</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="/mountainables">
                    @csrf
                    <div class="row mb-3">
                        <label for="nm_mountain" class="col-sm-4 col-form-label">Mountain Name</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="mountain_id" aria-label="Default select example">
                                @foreach ($mountains as $mountain)
                                    <option value="{{ $mountain->id }}" @if ($mountain->check_active == 0) disabled @endif>
                                        {{ $mountain->nm_mountain }} - {{ $mountain->address_mountain }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="date_able" class="col-sm-4 col-form-label">Date Able</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control @error('date_able') is-invalid @enderror"
                                id="date_able" name="date_able">
                            @error('date_able')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="max_people" class="col-sm-4 col-form-label">Maximum Climbers</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control @error('max_people') is-invalid @enderror"
                                id="max_people" name="max_people">
                            @error('max_people')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="price" class="col-sm-4 col-form-label">Price</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">add new data</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(function() {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var minDate = year + '-' + month + '-' + day;

            $('#date_able').attr('min', minDate);
        });
    </script>
@endsection
