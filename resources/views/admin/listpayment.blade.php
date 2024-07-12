@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="/payments">
                <div class="row">
                    @if (request('user'))
                        <input type="hiden" name="user" value="{{ request('user') }}">
                    @endif
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search"
                            value="{{ request('search') }}" aria-describedby="button-addon2">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="tgl_awal" class="form-control" value="{{ request('tgl_awal') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir') }}">
                    </div>
                    <div class="col-3">
                        <input type="submit" class="btn btn-primary border-0">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Payment Climbers
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($payments->count())
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Payment ID</th>
                                <th>Name</th>
                                <th>Group Code</th>
                                {{-- <th>Mountain</th> --}}
                                <th>Payment Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>PAY-MTN-00{{ $payment->id }}</td>
                                    <td>{{ $payment->user->name }}</td>
                                    <td>MTN-00{{ $payment->group_id }}</td>
                                    {{-- <td>{{ $payment->mountain_id }}</td> --}}

                                    {{-- <td>{{ $payment->group->group_name }}</td>
                                    <td>{{ $payment->group->mountain->nm_mountain }}</td> --}}
                                    <td>{{ date('d-m-Y', strtotime($payment->pay_date)) }}</td>

                                    <td>
                                        @if ($payment->status_pay == '0')
                                            <span class="badge rounded-pill bg-warning text-light">Pending</span>
                                        @elseif ($payment->status_pay == '1')
                                            <span class="badge rounded-pill bg-success">Completed</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Decline</span>
                                        @endif


                                    <td>
                                        <a href="/payments/{{ $payment->id }}/edit" class="badge bg-warning"><span
                                                class="fa-solid fa-pen-to-square"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center fs-6">Data not found....</p>
                @endif
            </div>
        </div>
    </div>
@endsection
