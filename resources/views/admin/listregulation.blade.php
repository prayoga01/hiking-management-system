@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-4 mb-3">
            <form action="/regulations">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search"
                        value="{{ request('search') }}" aria-describedby="button-addon2">
                    {{-- <button class="badge bg-success border-0" type="submit"><i class="fas fa-search"></i></button> --}}
                </div>
            </form>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                News & Regulation List
            </h6>
        </div>
        <div class="card-body">
            <a href="/regulations/create"><button type="button" class="btn btn-primary mb-3">Creat New List</button></a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>content</th>
                            <th>Created at</th>
                            <th>Last Update</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($regulations as $regulation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $regulation->type }}</td>
                                <td>{{ $regulation->title }}</td>
                                <td> {!! \Illuminate\Support\Str::limit($regulation->content, 85, $end = '...') !!}</td>
                                <td>{{ date('j F Y', strtotime($regulation->created_at)) }}</td>
                                <td>{{ $regulation->updated_at }}</td>
                                <td>
                                    <a href="/regulations/{{ $regulation->id }}/edit" class="badge bg-warning"><span
                                            class="fa-solid fa-pen-to-square"></span></a>
                                    <form action="/regulations/{{ $regulation->id }}" method="POST" class="d-inline">
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
            </div>
        </div>
    </div>
@endsection
