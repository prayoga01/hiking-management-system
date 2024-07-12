@extends('layouts.admin')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Mountain List</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="{{ route('admin.updateuser', $user->id) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <label for="name" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-4 col-form-label">Email Address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="status" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_admin" value="2"
                                    id="flexRadioDefault1" {{ $user->is_admin == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Officer
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_admin" id="flexRadioDefault2"
                                    value="0" {{ $user->is_admin == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    User
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
