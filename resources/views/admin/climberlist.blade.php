@extends('layouts.admin')

@section('content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <form action="/climbers">
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Group Climber List
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($payments->count())
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Group Code</th>

                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Status Climbing</th>
                                <th>Finsih At</th>
                                <th>Last Modifay</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>MTN-00{{ $payment->group->id }}</td>

                                    <td>{{ $payment->group->checkIn }}</td>
                                    <td>{{ $payment->group->checkOut }}</td>
                                    <td>
                                        @if ($payment->group->status == '0')
                                            <span class="badge rounded-pill bg-info text-light">Not Start</span>
                                        @elseif ($payment->group->status == '1')
                                            <span class="badge rounded-pill bg-success">Start</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Finish</span>
                                        @endif
                                    </td>
                                    <td>{{ $payment->group->finish }}</td>
                                    <td>{{ $payment->group->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('rsv.climbedit', $payment->group->id) }}"
                                            class="badge bg-warning">
                                            <span class="fa-solid fa-pen-to-square"></span>

                                            <a href="{{ route('rsv.members', $payment->group->id) }}"
                                                class="badge bg-info">
                                                <span class="fas fa-info-circle"></span>
                                            </a>
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
