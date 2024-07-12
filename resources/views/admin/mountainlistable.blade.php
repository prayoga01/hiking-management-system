@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <form action="/mountainables">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold" for="tgl_lahir">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search"
                            value="{{ request('search') }}" aria-describedby="button-addon2">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold" for="tgl_lahir">Tanggal Awal</label>
                        <input type="date" name="tgl_awal" class="form-control" value="{{ request('tgl_awal') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold" for="tgl_lahir">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary border-0">Submit</button>
                        {{-- <input type="submit" class="btn btn-primary border-0"> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Mountain List Able
            </h6>
        </div>
        <div class="card-body">
            <a href="/mountainables/create"><button type="button" class="btn btn-primary mb-3">Creat New List</button></a>
            <div class="table-responsive">
                @if ($mountainAbles->count())
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Moutain Name - Address </th>
                                <th>Maximum Climbers</th>
                                <th>Date</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mountainAbles as $mountainAble)
                                @php
                                    $mountain = DB::table('mountains')
                                        ->where('id', $mountainAble->mountain_id)
                                        ->first();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mountain->nm_mountain }} - {{ $mountain->address_mountain }}</td>
                                    <td>{{ $mountainAble->max_people }}</td>
                                    <td>{{ date('d-m-Y', strtotime($mountainAble->date_able)) }}</td>
                                    <td>{{ $mountainAble->price }}</td>
                                    <td>
                                        <a href="/mountainables/{{ $mountainAble->id }}/edit" class="badge bg-warning"><span
                                                class="fa-solid fa-pen-to-square"></span></a>
                                        <form action="{{ route('mountainables.destroy', $mountainAble->id) }}"
                                            method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                        </form>
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
