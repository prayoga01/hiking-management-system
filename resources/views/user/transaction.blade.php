@extends('layouts.landing')

@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Transaction Record</h2>
                <ol>
                    <li class="filter-option active">All</li>
                    <li class="filter-option">Waiting List</li>
                    <li class="filter-option">Paid</li>
                    <li class="filter-option">Waiting Confirmation</li>
                </ol>
            </div>
        </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($reservation as $rsv)
                    @php
                        $mtn = App\Models\Mountain::find($rsv->mountain_id);
                        $mtnable = App\Models\MountainAble::find($rsv->mountainAble_id);
                        $num = count(App\Models\Reservation::where('group_id', $rsv->id)->get());
                        $price = $num * $mtnable->price;
                        $payment = App\Models\Payment::where('group_id', $rsv->id)->first();
                    @endphp

                    <a href="/mountaindetails/{{ $rsv->mountain_id }}/group/{{ $rsv->id }}" style="color:black">
                        <div class="col-12 info-panel mb-3">
                            <div class="card-header float-end">
                                <h6 class="text-secondary">
                                    @if (is_null($payment))
                                        WAITING TO COMPLETE
                                    @else
                                        @if ($payment->status_pay == 1)
                                            RESERVATION PAID
                                        @elseif($payment->status_pay == 0)
                                            WAITING FOR CONFIRMATION
                                        @endif
                                    @endif
                                </h6>
                            </div>
                            <br>
                            <hr>
                            <div class="row d-flex justify-content-between">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <div>
                                            <img src="{{ asset('storage/' . $mtn->mountain_img) }}"
                                                class="img-fluid rounded-3" alt="Mountain Image" style="width: 100px;">
                                        </div>
                                        <div class="ms-3">
                                            <h5>{{ $mtn->nm_mountain }}</h5>
                                            <p class="small mb-0">Check In: {{ $rsv->checkIn }}</p>
                                            <p class="small mb-0"> {{ $rsv->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <div style="width: 50px;">
                                            <h5 class="fw-normal mb-0">x{{ $num }}</h5>
                                        </div>
                                        <div style="width: 100px;">
                                            <h5 class="mb-0">RM{{ $mtnable->price }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-footer d-flex justify-content-end">
                                <div class="d-flex flex-row align-items-center">
                                    <div style="width: 150px;">
                                        <b>Total Payment:</b>
                                    </div>
                                    <div style="width: 100px;">
                                        <h5 class="mb-0">RM{{ $price }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Portfolio Details Section -->
    <style>
        .filter-option.active {
            color: green;
            text-decoration: underline;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-option');
            const infoPanels = document.querySelectorAll('.info-panel');

            filterButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove active class from all filter options
                    filterButtons.forEach(function(btn) {
                        btn.classList.remove('active');
                    });

                    // Add active class to the selected filter option
                    this.classList.add('active');

                    const filterValue = this.textContent.trim().toLowerCase();

                    infoPanels.forEach(function(panel) {
                        const panelStatus = panel.querySelector('.card-header h6')
                            .textContent.trim().toLowerCase();

                        if (filterValue === 'all') {
                            panel.style.display = 'block';
                        } else if (filterValue === 'waiting list' && panelStatus ===
                            'waiting to complete') {
                            panel.style.display = 'block';
                        } else if (filterValue === 'paid' && panelStatus ===
                            'reservation paid') {
                            panel.style.display = 'block';
                        } else if (filterValue === 'waiting confirmation' && panelStatus ===
                            'waiting for confirmation') {
                            panel.style.display = 'block';
                        } else {
                            panel.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
@endsection
