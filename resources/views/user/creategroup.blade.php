    @extends('layouts.landing')

    @section('content')
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Form Booking</h2>
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li>Group Registration</li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- Breadcrumbs Section -->


        <section id="portfolio-details" class="portfolio-details">
            <div class="container">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-5"
                            style="max-height: 350px; max-width: 413px; overflow: hidden; position: relative">
                            <img src="{{ asset('assets/img/mountainmate-logo.png') }}" class="img-fluid rounded-start"
                                alt="..." style="">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h2>Form Group</h2>
                                <form method="POST"
                                    action="{{ route('rsv.groupstore', ['id_mtnable' => $mountainable->id]) }}">

                                    @csrf
                                    <div class="control-group after-add-more">
                                        <div class="row mb-3 mt-3">
                                            <label for="checkIn" class="col-sm-4 col-form-label"
                                                style="font-family: sans-serif"><strong>
                                                    Check In</strong></label>
                                            <div class="col-sm-8">
                                                {{-- <input type="date"
                                                    class="form-control @error('checkIn') is-invalid @enderror"
                                                    id="checkIn" name="checkIn" value="{{ $mountainable->date_able }}"
                                                    style="font-family: sans-serif" readonly> --}}
                                                <input type="date"
                                                    class="form-control @error('checkIn') is-invalid @enderror"
                                                    id="checkIn" name="checkIn" value="{{ $mountainable->date_able }}"
                                                    readonly>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="checkOut"
                                                class="col-sm-4 col-form-label"style="font-family: sans-serif"><strong>
                                                    Check Out</strong></label>
                                            <div class="col-sm-8">
                                                <input type="date"
                                                    class="form-control @error('checkOut') is-invalid @enderror"
                                                    id="checkOut" name="checkOut" style="font-family: sans-serif"
                                                    autofocus>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mb-3">
                                            <label for="group_namme" class="col-sm-4 col-form-label"
                                                style="font-family: sans-serif"><strong>
                                                    Group Name</strong></label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                    class="form-control @error('group_namme') is-invalid @enderror"
                                                    id="group_namme" name="group_name" style="font-family: sans-serif"
                                                    autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success float-end mb-2">Submit data</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
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

                $('#checkOut').attr('min', minDate);
            });
        </script>
    @endsection
