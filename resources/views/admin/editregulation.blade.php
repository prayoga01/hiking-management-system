@extends('layouts.admin')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add News & Regulation</h6>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="POST" action="/regulations/{{ $regulation->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <label for="nm_mountain" class="col-sm-4 col-form-label">Category</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="type" aria-label="Default select example" autofocus>
                                <option value="News" @if ($regulation->type == 'News') selected @endif>News
                                </option>
                                <option value="Regulation" @if ($regulation->type == 'Regulation') selected @endif>Regulation
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="title" class="col-sm-4 col-form-label">Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title', $regulation->title) }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image" class="col-sm-4 col-form-label">Content Image</label>
                        <div class="col-sm-8 mb-3">
                            <input type="hidden" name="oldFile" value="{{ $regulation->image }}">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" onchange="previewImage()">
                            @if ($regulation->image)
                                <img src="{{ asset('storage/' . $regulation->image) }}" alt=""
                                    class="img-preview img-fluid mt-3">
                            @else
                                <img class="img-preview img-fluid mt-3">
                            @endif

                            @error('image')
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
                        <input id="content2" type="hidden" name="content"
                            value="{{ old('content', $regulation->content) }}">
                        <trix-editor input="content2"></trix-editor>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit data</button>
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
