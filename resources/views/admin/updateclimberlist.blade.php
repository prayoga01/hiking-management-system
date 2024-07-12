@extends('layouts.admin')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="{{ route('rsv.climbupdate', $group->id) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <label for="nm_mountain" class="col-sm-4 col-form-label">Group</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('group_name') is-invalid @enderror"
                                id="group_name" name="group_name" value="{{ old('group_name', $group->group_name) }}"
                                readonly>
                            @error('group_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="leader" class="col-sm-4 col-form-label">Leader Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id"
                                name="user_id" value="{{ old('user_id', $group->user->name) }}" readonly>
                            @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="mountain" class="col-sm-4 col-form-label">Mountain Name</label>
                        <div class="col-sm-8 mb-3">
                            <input type="text" class="form-control @error('mountain_id') is-invalid @enderror"
                                id="mountain_id" name="mountain_id"
                                value="{{ old('mountain_id', $group->mountain->nm_mountain) }}" readonly>
                            @error('mountain_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="checkIn" class="col-sm-4 col-form-label">Check In</label>
                        <div class="col-sm-8 mb-3">
                            <input type="date" class="form-control @error('checkIn') is-invalid @enderror" id="checkIn"
                                name="checkIn" value="{{ old('checkIn', $group->checkIn) }}" readonly>
                            @error('checkIn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="checkOut" class="col-sm-4 col-form-label">CheckOut</label>
                        <div class="col-sm-8 mb-3">
                            <input type="date" class="form-control @error('checkOut') is-invalid @enderror"
                                id="checkOut" name="checkOut" value="{{ old('checkOut', $group->checkOut) }}" readonly>
                            @error('checkOut')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="status" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="0"
                                    id="flexRadioDefault1" {{ $group->status == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Not Start
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="1"
                                    id="flexRadioDefault1" {{ $group->status == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Start
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="2"
                                    id="flexRadioDefault1" {{ $group->status == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Finish
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="finish" class="col-sm-4 col-form-label">Finih At</label>
                        <div class="col-sm-8 mb-3">
                            <input type="date" class="form-control @error('checkOut') is-invalid @enderror"
                                name="finish" value="{{ $group->finish }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Edit data</button>
                </form>
            </div>
        </div>
    @endsection
