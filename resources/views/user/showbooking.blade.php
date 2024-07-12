@extends('layouts.landing')

@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Detail Booking</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>{{ $mountainable->mountain->nm_mountain }}</li>
                    <li>Detail Booking</li>
                </ol>
            </div>

        </div>
    </section><!-- Breadcrumbs Section -->


    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="portfolio-info">
                <div class="row gy-4">
                    <div class="col-lg-8">
                        <div class="portfolio-details-slider swiper">
                            <div class="swiper-slide">
                                <div class="card shadow mb-4" style="border: none">
                                    <div class="card-header py-3">
                                        <h6 class="font-weight-bold text-dark">
                                            Member Group (Group :
                                            {{ $group->group_name }})</h6>
                                        <h1>MTN-00{{ $group->id }}</h1>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <form>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">ID Number</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($rsvs as $rsv)
                                                            <tr>
                                                                <th scope="row">{{ $loop->iteration }}</th>
                                                                <td>{{ $rsv->name }}</td>
                                                                <td>{{ $rsv->idn_numb }}</td>
                                                                <td>
                                                                    @if (is_null($payment))
                                                                        <form
                                                                            action="{{ route('rsv.destroy', ['id' => $mountainable->id, 'group' => $group->id]) }}"
                                                                            method="POST" class="d-inline">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <input type="hidden" name="id_rsv"
                                                                                value="{{ $rsv->id }}">
                                                                            <button class="badge bg-danger border-0"><i
                                                                                    class="fas fa-trash"
                                                                                    style="color: #ffffff;"></i></button>
                                                                        </form>
                                                                    @else
                                                                        <small class="text-secondary">no action
                                                                            available</small>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    @if (is_null($payment))
                                                        {{-- <a class="btn btn-success"
                                                            href="{{ route('rsv.create', ['id' => $mountain->id, 'group' => $group->id]) }}"><i
                                                                class="fas fa-user-plus" style="color: #ffffff;"></i> Add
                                                            Member</a> --}}
                                                        <a class="btn btn-success"
                                                            href="{{ route('rsv.create', ['id' => $mountainable->id, 'group' => $group->id]) }}"><i
                                                                class="fas fa-user-plus" style="color: #ffffff;"></i> Add
                                                            Member</a>
                                                    @endif
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="d-grid gap-2">
                                    @if (is_null($payment))
                                        <a class="btn btn-success" type="button"
                                            href="{{ route('pay.create', ['id' => $mountain->id, 'group' => $group->id]) }}">Continue
                                            To Payment</a>
                                    @elseif($payment->status_pay == 0)
                                        <div class="alert alert-info" role="alert">
                                            Please wait for the admin to confirm your payment
                                        </div>
                                    @else
                                        <a class="btn btn-success" type="button" style="color: #ffffff"
                                            href="{{ route('pay.show', ['id' => $mountain->id, 'group' => $group->id]) }}"
                                            target="_blank">Print
                                            Invoice <i class="fa-solid fa-print" style="color: #f5f5f5;"></i></a>
                                    @endif
                                </div> --}}
                                <div class="d-grid gap-2">
                                    @if (is_null($payment))
                                        <a class="btn btn-success" type="button"
                                            href="{{ route('pay.create', ['id' => $mountainable->id, 'group' => $group->id]) }}">Continue
                                            To Payment</a>
                                    @elseif($payment->status_pay == 0)
                                        <div class="alert alert-info" role="alert">
                                            Please wait for the admin to confirm your payment
                                        </div>
                                    @else
                                        <a class="btn btn-success" type="button" style="color: #ffffff"
                                            href="{{ route('pay.show', ['id' => $mountainable->id, 'group' => $group->id]) }}"
                                            target="_blank">Print
                                            Invoice <i class="fa-solid fa-print" style="color: #f5f5f5;"></i></a>
                                    @endif
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
                                    <strong>Location</strong>: {{ $mountainable->mountain->address_mountain }}
                                </li>
                                <li>
                                    <strong>Check In</strong>:
                                    {{ \Carbon\Carbon::parse($mountainable->date_able)->format('d-m-Y') }}
                                </li>
                            </ul>
                            <hr style="color:rgb(99, 99, 103)">
                            @php
                                $num = count($rsvs);
                                $price = $num * $mountainable->price;
                            @endphp
                            <p style="font-size: 14px">Total Climbers : <strong>{{ $num }}</strong></p>
                            <p style="font-size: 14px">Price : <strong>MYR {{ $mountainable->price }}</strong></p>
                            <b style="font-size: 14px">Total payment : <strong style="color: rgb(31, 150, 53)">MYR
                                    {{ $price }}</strong></b>
                        </div>


                    </div>

                </div>
            </div>

        </div>

    </section>
    <!-- End Portfolio Details Section -->
@endsection
