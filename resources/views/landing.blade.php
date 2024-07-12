@extends('layouts.user')

@section('content')
    <main id="mt_list">
        <section class="more-services section-bg">
            <div class="container">
                <div class="section-title">
                    <h2>Mountain List</h2>
                </div>
                <div class="row">
                    @foreach ($mountains as $mountain)
                        <div class=" zoom-effect col-lg-4 col-md-6 d-flex align-items-stretch mb-5 mb-lg-0">
                            <a href="/mountaindetails/{{ $mountain->id }}">
                                <div class="card ">
                                    <div style="max-height: 600px; max-width: 426px; overflow: hidden; position: relative;">
                                        <img src="{{ asset('storage/' . $mountain->mountain_img) }}" class="card-img-top"
                                            alt="..." style="object-fit: cover; width: 100%; height: 100%;">
                                        <div class="image-caption">
                                            <h5 class="card-title">{{ $mountain->nm_mountain }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        {{-- <!-- ======= Mountain List ======= -->
        <section class="more-services section-bg">
            <div class="container">
                <div class="section-title">
                    <h2>Mountain List</h2>
                </div>
                <div class="row">
                    @foreach ($mountains as $mountain)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-5 mb-lg-0">
                            <div class="card">
                                <div style="max-height: 150px; max-width: 250px; overflow:hidden;">
                                    <img src="{{ asset('storage/' . $mountain->mountain_img) }}" class="card-img-top"
                                        alt="...">
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title"><a href="">{{ $mountain->nm_mountain }}</a></h5>
                                    <p class="card-text text-center"><i class="fa-solid fa-location-dot"
                                            style="color: #fa0000;"></i> {{ $mountain->address_mountain }}</p>
                                    <p class="card-text text-center">
                                        @if ($mountain->check_active == '1')
                                            <span class="badge text-bg-success">Active</span>
                                        @elseif($mountain->check_active == '0')
                                            <span class="badge text-bg-warning">Inactive</span>
                                        @endif
                                    </p>
                                    <a href="/mountaindetails/{{ $mountain->id }}">Booking Now &raquo;</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Mountain List --> --}}



        <!-- ======= Our Services Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <h2>HIKING TIPS FOR BEGINERS</h2>
                    <p>"If you're a beginner in hiking, don't worry! We have some advice to help you plan a successful and
                        enjoyable hiking trip."</p>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-lg-0 mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fa-solid fa-group-arrows-rotate" style="color: #1e3050;"></i>
                            </div>
                            <h4 class="title"><a href="">Hike With Partner/Group</a></h4>
                            <p class="description">It's
                                Hike with a partner/group for safety and enjoyment.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-lg-0 mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fa-solid fa-location-dot" style="color: #1e3050;"></i></i>
                            </div>
                            <h4 class="title"><a href="">Pick A Distance You Can Handle</a></h4>
                            <p class="description">Choose a distance that matches your fitness level and experience.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-lg-0 mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fa-solid fa-bullhorn" style="color: #1e3050;"></i></div>
                            <h4 class="title"><a href="">Tell Someone</a></h4>
                            <p class="description">Always tell someone where you're going.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch  mb-lg-0 mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fa-solid fa-person-walking" style="color: #1e3050;"></i></div>
                            <h4 class="title"><a href="">Don't Be Too Ambitious</a></h4>
                            <p class="description">Don't take on more than you can handle.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch  mb-lg-0 mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fa-solid fa-person-running" style="color: #22304e;"></i>
                            </div>
                            <h4 class="title"><a href="">Take Practice At A Local Park</a></h4>
                            <p class="description">Practice at a local park to build up your fitness level.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch  mb-lg-0 mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fa-solid fa-id-card-clip" style="color: #1e3050;"></i></div>
                            <h4 class="title"><a href="">Join A Hiking Club</a></h4>
                            <p class="description">Join a hiking club to learn from experienced hikers.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch  mb-lg-0 mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="fa-solid fa-trash" style="color: #1e3050;"></i></div>
                            <h4 class="title"><a href="">Don't Leave Trash In The Woods</a></h4>
                            <p class="description">Pack out your trash and leave the environment as you found it.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Our Services Section -->

        <!-- ======= Cta Section ======= -->
        <section class="cta" style="background-image: url({{ asset('assets/img/mountain2.jpg') }});">
            <div class="container">

                <div class="text-center">
                    <h3>Call To Action</h3>
                    <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim id est laborum.</p>
                </div>

            </div>
        </section><!-- End Cta Section -->


        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container">
                <div class="section-title">
                    <h2>NEWS & REGULATION</h2>
                </div>
                @php $count = 0; @endphp
                @foreach ($regulations as $regulation)
                    @php $count++; @endphp
                    <div class="row">
                        <div class="col-lg-6 mb-3"
                            style="max-height: 350px; max-width: 413px; overflow: hidden; position: relative">
                            <img src="{{ asset('storage/' . $regulation->image) }}" class="img-fluid rounded-start"
                                alt="...">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <h4><strong>{{ $regulation->type }}</strong></h4>
                            <h5><a href="/news/{{ $regulation->id }}"><strong>{{ $regulation->title }}</strong></a></h5>
                            <small>
                                <strong> Update at</strong> :
                                {{ date('d M Y', $regulation->created_at->timestamp) }}
                            </small>
                            <p>
                                {!! \Illuminate\Support\Str::limit($regulation->content, 299, $end = '...') !!}
                            </p>
                            <hr>
                        </div>
                    </div>
                    @if ($count === 2 && count($regulations) > 2)
                        <div class="text-center">
                            <a href="/news" class="btn btn-success">See More</a>
                        </div>
                    @break
                @endif
            @endforeach
        </div>
    </section>




    <!-- End About Us Section -->
    <!-- ======= About Us Section ======= -->
    {{-- <section id="about" class="about">
            <div class="container">

                <div class="section-title">
                    <h2>About Us</h2>
                    <p> This system is a collaborative project between MSU and the state Forestry Department to manage and
                        track the access
                        of visitors requesting to hike the local mountains. Each mountain managed by the local Forestry
                        Department has a limit of approved hikers that are allowed to hike the mountain. </p>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ asset('assets/img/mountain3.jpg') }}" class="img-fluid" alt="">

                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content">
                        <h3>We present<strong> MountainMate</strong></h3>
                        <p>
                            We are proud to present this program, which is the result of a collaboration between management
                            and science university (MSU) and the Ministry of Forestry. In this collaboration, we strive to
                            provide
                            the best solutions for our users by using the experience and knowledge of both parties.
                        </p>
                        <small><b> ~ Experience the Mountains with Simplified Booking - planning your trip easier than
                                ever! ~</b></small>
                    </div>
                </div>

            </div>
        </section> --}}
    <!-- End About Us Section -->


</main>
@endsection
