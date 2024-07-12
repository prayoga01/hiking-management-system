@extends('layouts.landing')

@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Mountain Details</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>{{ $mountain->nm_mountain }}</li>
                </ol>
            </div>
        </div>
    </section><!-- Breadcrumbs Section -->


    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $mountain->mountain_img) }}" alt="...">
                        </div>
                    </div>
                </div>


                {{-- <div class="weather">
                    <div class="col-lg-6">
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <h6 class="flex-grow-1">Warsaw</h6>
                                <h6>15:07</h6>
                            </div>

                            <div class="d-flex flex-column text-center mt-5 mb-4">
                                <h6 class="display-4 mb-0 font-weight-bold" style="color: #1c2331">
                                    13°C
                                </h6>
                                <span class="small" style="color: #868b94">Stormy</span>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1" style="font-size: 1rem">
                                    <div>
                                        <i class="fas fa-wind fa-fw" style="color: #868b94"></i>
                                        <span class="ms-1"> 40 km/h </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-tint fa-fw" style="color: #868b94"></i>
                                        <span class="ms-1"> 84% </span>
                                    </div>
                                    <div>
                                        <i class="fas fa-sun fa-fw" style="color: #868b94"></i>
                                        <span class="ms-1"> 0.2h </span>
                                    </div>
                                </div>
                                <div>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-weather/ilu1.webp"
                                        width="100px" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="col-lg-6">
                    <div class="weather">
                        <div class="card-body p-4">
                            <!-- Tampilkan informasi cuaca di sini -->
                            @if ($weatherData)
                                <div class="d-flex">
                                    <h6 class="flex-grow-1">{{ $weatherData['name'] }}</h6>
                                </div>

                                <div class="d-flex flex-column text-center mt-5 mb-4">
                                    <h6 class="display-4 mb-0 font-weight-bold" style="color: #1c2331">
                                        {{ round($weatherData['main']['temp'] - 273.15) }}°C
                                    </h6>
                                    <span class="small"
                                        style="color: #868b94">{{ $weatherData['weather'][0]['description'] }}</span>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1" style="font-size: 1rem">
                                        <div>
                                            <i class="fas fa-wind fa-fw" style="color: #868b94"></i>
                                            <span class="ms-1">{{ $weatherData['wind']['speed'] }} km/h</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-tint fa-fw" style="color: #868b94"></i>
                                            <span class="ms-1">{{ $weatherData['main']['humidity'] }}%</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-cloud fa-fw" style="color: #868b94"></i>
                                            <span class="ms-1">{{ $weatherData['clouds']['all'] }}%</span>
                                        </div>
                                    </div>
                                    <img src="https://openweathermap.org/img/w/{{ $weatherData['weather'][0]['icon'] }}.png"
                                        width="100px" />
                                </div>
                            @else
                                <p>Gagal memuat data cuaca.</p>
                            @endif
                        </div>
                    </div>
                </div>





                <table class="table text-center mt-5">
                    <thead>
                        <tr>
                            <th scope="col">Price</th>
                            <th scope="col">Maximum Climbers</th>
                            <th scope="col">Date Able</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ables as $able)
                            @php
                                $dateAble = \Carbon\Carbon::parse($able->date_able);
                                $now = \Carbon\Carbon::now();
                            @endphp
                            @if ($dateAble->greaterThanOrEqualTo($now) || $dateAble->isSameDay($now))
                                <tr>
                                    <td>RM {{ $able->price }}</td>
                                    <td>{{ $able->max_people }}</td>
                                    <td>{{ date('d-m-Y', strtotime($able->date_able)) }}</td>

                                    <td>
                                        @if ($mountain->check_active == '1')
                                            @if ($able->max_people == 0)
                                                <button type="button" class="badge bg-secondary" disabled>Not able for
                                                    now</button>
                                            @else
                                                {{-- <a href="{{ route('rsv.group', $able->mountain_id) }}"
                                                    class="badge bg-success border-0">
                                                    Booking Now
                                                </a> --}}
                                                <a href="{{ route('rsv.group', $able->id) }}"
                                                    class="badge bg-success border-0">
                                                    Booking Now
                                                </a>
                                            @endif
                                        @elseif($mountain->check_active == '0')
                                            <button type="button" class="badge bg-secondary" disabled>Not able for
                                                now</button>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        {{-- @foreach ($ables as $able)
                                <tr>
                                    <td>RM {{ $able->price }}</td>
                                    <td>{{ $able->max_people }}</td>
                                    <td>{{ $able->date_able }}</td>
                                    <td>
                                        @if ($mountain->check_active == '1')
                                            @if ($able->max_people == 0)
                                                <button type="button" class="badge bg-secondary" disabled>Not able for
                                                    now</button>
                                            @else
                                                <a href="{{ route('rsv.group', $able->id) }}"
                                                    class="badge bg-success border-0">
                                                    Booking Now
                                                </a>
                                            @endif
                                        @elseif($mountain->check_active == '0')
                                            <button type="button" class="badge bg-secondary" disabled>Not able for
                                                now</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                    </tbody>
                </table>

                <div class="portfolio-description">
                    <h2>About {{ $mountain->nm_mountain }}</h2>
                    <p class="text-break">
                        {!! $mountain->content !!}
                    </p>
                </div>

            </div>
        </div>
    </section><!-- End Portfolio Details Section -->


@endsection
