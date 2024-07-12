@extends('layouts.landing')

@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Payment</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    {{-- <li>{{ $mountainable->mountain->nm_mountain }}</li> --}}
                    <li>Booking</li>
                </ol>
            </div>

        </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="portfolio-info">
                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-10">
                        <div class="portfolio-details-slider swiper">
                            <div class="swiper-slide">
                                <form method="POST"
                                    action="{{ route('pay.store', ['id' => $mountainable->id, 'group' => $group->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="control-group after-add-more">
                                        <div class="row mb-3">
                                            <label for="name" class="col-sm-4 col-form-label">Mountain name</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="{{ $mountainable->mountain->nm_mountain }}"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="name" class="col-sm-4 col-form-label">Group name</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="{{ $group->group_name }}"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="total" class="col-sm-4 col-form-label">Total payment</label>
                                            <div class="col-sm-8">
                                                @php
                                                    $num = count($rsvs);
                                                    $price = $num * $mountainable->price;
                                                @endphp
                                                <input type="number" value="{{ $price }}"
                                                    class="form-control @error('total') is-invalid @enderror" id="total"
                                                    name="total" readonly>
                                                @error('total')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="pay_date" class="col-sm-4 col-form-label">Transaction date</label>
                                            <div class="col-sm-8">
                                                <input type="date"
                                                    class="form-control @error('pay_date') is-invalid @enderror"
                                                    id="pay_date" name="pay_date">
                                                @error('pay_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="ref_id" class="col-sm-4 col-form-label">Reference number</label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                    class="form-control @error('ref_id') is-invalid @enderror"
                                                    id="ref_id" name="ref_id">
                                                @error('ref_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="proof_pay" class="col-sm-4 col-form-label">Proof of payment</label>
                                            <div class="col-sm-8">

                                                <input type="file"
                                                    class="form-control @error('proof_pay') is-invalid @enderror"
                                                    id="proof_pay" name="proof_pay" onchange="previewImage()">
                                                @error('proof_pay')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="no_tlp" class="col-sm-4 col-form-label"></label>
                                            <div class="col-sm-8">
                                                <div class="form-floating">
                                                    <textarea name="note" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                                        style="height: 100px"></textarea>
                                                    <label for="floatingTextarea2">Comments</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit data</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- End Portfolio Details Section -->
    <script type="text/javascript">
        function previewImage() {
            const image = document.querySelector('#proof_pay');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
