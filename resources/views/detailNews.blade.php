@extends('layouts.landing')

@section('content')
    <!-- ======= Breadcrumbs Section ======= -->

    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>News & Regulation Details</h2>
                <ol>
                    <li><a href="/news">News & Regulation Details</a></li>
                    <li>{{ $regulation->type }}</li>
                </ol>
            </div>
        </div>
    </section><!-- Breadcrumbs Section -->


    

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-slide mb-3">
                            <h2><strong>{{ $regulation->title }}</strong></h2>
                            {{-- slipkan size --}}
                            <img src="{{ asset('storage/' . $regulation->image) }}" alt="...">
                        </div>
                        <h2><strong>{{ $regulation->title }}</strong></h2>
                        <small>
                            <strong> Update at</strong> :
                            {{ date('d M Y', $regulation->created_at->timestamp) }}
                        </small>
                        <p>
                            {!! $regulation->content !!}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Portfolio Details Section -->
@endsection
