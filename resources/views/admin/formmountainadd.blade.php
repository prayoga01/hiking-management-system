@extends('layouts.admin')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Mountain List</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="/addmountains" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="nm_mountain" class="col-sm-4 col-form-label">Mountain Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('nm_mountain') is-invalid @enderror"
                                id="nm_mountain" name="nm_mountain" value="{{ old('nm_mountain') }}">
                            @error('nm_mountain')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address_mountain" class="col-sm-4 col-form-label">Mountain Address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('address_mountain') is-invalid @enderror"
                                id="address_mountain" name="address_mountain" value="{{ old('address_mountain') }}">
                            @error('address_mountain')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="latitude" class="col-sm-4 col-form-label">Latitude</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                id="latitude" name="latitude" value="{{ old('latitude') }}">
                            @error('latitude')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="longitude" class="col-sm-4 col-form-label">Longitude</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                id="longitude" name="longitude" value="{{ old('longitude') }}">
                            @error('longitude')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="mountain_img" class="col-sm-4 col-form-label">Mountain Image</label>
                        <div class="col-sm-8 mb-3">
                            <input type="file" class="form-control @error('mountain_img') is-invalid @enderror"
                                id="mountain_img" name="mountain_img" onchange="previewImage()">
                            @error('mountain_img')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <img class="img-preview img-fluid">
                    </div>
                    <div class="mb-3">
                        <label for="content2" class="form-label">Content</label>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input id="content2" type="hidden" name="content" value="{{ old('content') }}">
                        <trix-editor input="content2"></trix-editor>
                    </div>
                    <button type="submit" class="btn btn-primary">add new data</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#mountain_img');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endsection
