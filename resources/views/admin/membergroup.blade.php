@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-slide">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-success">Form Detail</h6>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <form>
                                        @foreach ($group as $reservation)
                                            <div class="control-group after-add-more">
                                                <div class="row mb-3">
                                                    <label for="name" class="col-sm-4 col-form-label">Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                            value="{{ $reservation->name }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="birth" class="col-sm-4 col-form-label">Date of
                                                        birth</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="form-control"
                                                            value="{{ $reservation->birth }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="address" class="col-sm-4 col-form-label">Address</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                            value="{{ $reservation->address }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="gender" class="col-sm-4 col-form-label">Gender</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                {{ $reservation->gender == 'Male' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                {{ $reservation->gender == 'Female' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="inlineRadio2">Female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="no_tlp" class="col-sm-4 col-form-label">Phone
                                                        Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control"
                                                            value="{{ $reservation->no_tlp }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="nationality"
                                                        class="col-sm-4 col-form-label">Nationality</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="nationality"
                                                                {{ $reservation->nationality == 'Malaysia' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="inlineRadio1">Malaysia</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="nationality"
                                                                {{ $reservation->nationality == 'Non-malaysia' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="inlineRadio2">Non-malaysia</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="idn_numb" class="col-sm-4 col-form-label">Identity
                                                        Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control"
                                                            value="{{ $reservation->idn_numb }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="idn_img" class="col-sm-4 col-form-label">Identity
                                                        Image</label>
                                                    <div class="col-sm-8">
                                                        <input type="hidden" name="oldFile1"
                                                            value="{{ $reservation->idn_img }}">
                                                        @if ($reservation->idn_img)
                                                            <a class="btn btn-info col-sm-3 d-block mb-2" target="_blank"
                                                                href="{{ asset('storage/' . $reservation->idn_img) }}"><i
                                                                    class="fa-solid fa-file"></i> ID CARD</a>
                                                        @endif
                                                    </div>
                                                    <img class="img-preview img-fluid">
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
