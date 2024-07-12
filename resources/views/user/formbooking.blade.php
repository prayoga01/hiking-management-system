@extends('layouts.landing')

@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Form Booking</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>{{ $mountainable->mountain->nm_mountain }}</li>
                    <li>Booking</li>
                </ol>
            </div>

        </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-slide">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-success">Form Detail (Group :
                                        {{ $group->group_name }})</h6>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <form method="POST"
                                            action="{{ route('rsv.store', ['id' => $mountainable->id, 'group' => $group->id]) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="control-group after-add-more">
                                                <div class="row mb-3">
                                                    <label for="name" class="col-sm-4 col-form-label">Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="name" name="name">
                                                    </div>
                                                </div>
                                                {{-- <div class="row mb-3">
                                                    <label for="birth" class="col-sm-4 col-form-label">Date of
                                                        birth</label>
                                                    <div class="col-sm-8">
                                                        <input type="date"
                                                            class="form-control @error('birth') is-invalid @enderror"
                                                            id="birth" name="birth">
                                                        @error('birth')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div> --}}
                                                <div class="row mb-3">
                                                    <label for="birth" class="col-sm-4 col-form-label">Date of
                                                        birth</label>
                                                    <div class="col-sm-8">
                                                        <input type="date"
                                                            class="form-control @error('birth') is-invalid @enderror"
                                                            id="birth" name="birth">
                                                        @error('birth')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="age" class="col-sm-4 col-form-label">Age</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"
                                                            class="form-control @error('birth') is-invalid @enderror"
                                                            id="age" name="age" readonly>
                                                        @error('birth')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="address" class="col-sm-4 col-form-label">Address</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"
                                                            class="form-control @error('address') is-invalid @enderror"
                                                            id="address" name="address">
                                                        @error('address')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="gender" class="col-sm-4 col-form-label">Gender</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                value="Male">
                                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                value="Female">
                                                            <label class="form-check-label"
                                                                for="inlineRadio2">Female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="no_tlp" class="col-sm-4 col-form-label">Phone
                                                        Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="number"
                                                            class="form-control @error('no_tlp') is-invalid @enderror"
                                                            id="no_tlp" name="no_tlp">
                                                        @error('no_tlp')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="nationality"
                                                        class="col-sm-4 col-form-label">Nationality</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="nationality" value="Malaysia">
                                                            <label class="form-check-label"
                                                                for="inlineRadio1">Malaysia</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="nationality" value="Non-malaysia">
                                                            <label class="form-check-label"
                                                                for="inlineRadio2">Non-malaysia</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="idn_numb" class="col-sm-4 col-form-label">Identity
                                                        Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="number"
                                                            class="form-control @error('idn_numb') is-invalid @enderror"
                                                            id="idn_numb" name="idn_numb">
                                                        @error('idn_numb')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="idn_img" class="col-sm-4 col-form-label">Identity
                                                        Image</label>
                                                    <div class="col-sm-8">
                                                        <input type="file"
                                                            class="form-control @error('idn_img') is-invalid @enderror"
                                                            id="idn_img" name="idn_img" onchange="previewImage()">
                                                        @error('idn_img')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <img class="img-preview img-fluid">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit data</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>{{ $mountainable->mountain->nm_mountain }}</h3>
                        <ul>
                            <li>
                                <div style="max-height: 150px; max-width: 300px; overflow:hidden;">
                                    <img src="{{ asset('storage/' . $mountainable->mountain->mountain_img) }}"
                                        alt="...">
                                </div>
                            </li>
                            <li>
                                <strong>Location: {{ $mountainable->mountain->address_mountain }} </strong><br>
                                <strong>Check Out</strong>: {{ $group->checkOut }}<br>
                                <strong>Check Out</strong>: {{ $group->checkIn }}
                            </li>
                        </ul>
                    </div>


                </div>

            </div>

        </div>

    </section>
    <!-- End Portfolio Details Section -->
    <script type="text/javascript">
        function previewImage() {
            const image = document.querySelector('#idn_img');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const birthInput = document.getElementById('birth');
            const ageInput = document.getElementById('age');

            birthInput.addEventListener('change', function() {
                const birthDate = new Date(birthInput.value);
                const today = new Date();
                const age = today.getFullYear() - birthDate.getFullYear();

                // Periksa apakah ulang tahun pengguna sudah lewat atau belum
                if (today.getMonth() < birthDate.getMonth() || (today.getMonth() === birthDate.getMonth() &&
                        today.getDate() < birthDate.getDate())) {
                    age--;
                }

                // Isi otomatis input umur
                ageInput.value = age;
            });
        });
    </script>
@endsection
