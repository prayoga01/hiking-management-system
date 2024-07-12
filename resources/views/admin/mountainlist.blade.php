@extends('layouts.admin')

@section('content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-4 mb-3">
            <form action="/addmountains">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search"
                        value="{{ request('search') }}" aria-describedby="button-addon2">
                    {{-- <button class="badge bg-success border-0" type="submit"><i class="fas fa-search"></i></button> --}}
                </div>
            </form>
        </div>
        <div class="col-md-4 mb-3">
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate
                Report</a>
        </div>

    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Mountain List
            </h6>
        </div>
        <div class="card-body">
            <a href="/addmountains/create"><button type="button" class="btn btn-primary mb-3">Creat New List</button></a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Moutain Name</th>
                            <th>Mountain Address</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Status Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mountains as $mountain)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mountain->nm_mountain }}</td>
                                <td>{{ $mountain->address_mountain }}</td>
                                <td>{{ $mountain->latitude }}</td>
                                <td>{{ $mountain->longitude }}</td>
                                <td>
                                    {{-- <span
                                        @if ($mountain->check_active == '1') class="badge rounded-pill bg-success text-white"  
                                        @else 
                                        class="badge rounded-pill bg-warning text-dark" @endif>
                                        {{ $mountain->check_active }}
                                    </span> --}}
                                    @if ($mountain->check_active == '1')
                                        <span class="badge rounded-pill bg-success text-white">Active</span>
                                    @elseif($mountain->check_active == '0')
                                        <span class="badge rounded-pill bg-warning text-white">Inactive</span>
                                    @endif

                                </td>



                                {{-- <td>
                                    <!-- Default switch -->
                                    <div class="custom-control custom-switch">
                                        <form method="POST" action="/addmountains/{{ $mountain->id }}">
                                            <input data-id="{{ $mountain->id }}" type="checkbox"
                                                class="toggle-class custom-control-input" data-onstyle="success"
                                                data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                data-off="InActive" {{ $mountain->status ? 'checked' : '' }}
                                                id="customSwitches" name="status">
                                            <label class="custom-control-label" for="customSwitches"></label>
                                        </form>

                                    </div>
                                </td> --}}
                                <td>
                                    <a href="/addmountains/{{ $mountain->id }}/edit" class="badge bg-warning"><i
                                            class="fa-solid fa-pen-to-square"></i></i></a>
                                    <form action="/addmountains/{{ $mountain->id }}" method="POST" class="d-inline">
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
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeStatus',
                    data: {
                        'check_active': status,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
@endsection
