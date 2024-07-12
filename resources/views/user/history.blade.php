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
@endsection
