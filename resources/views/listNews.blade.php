@extends('layouts.landing')

@section('content')
    <section class="cta" style="background-image: url({{ asset('assets/img/mountain2.jpg') }});">
        <div class="container">

            <div class="text-center">
                <img src="{{ asset('assets/img/invoice_logo.png') }}" class="img-fluid rounded-start mb-3" alt="..."
                    style="max-height: 100px; max-widh: 100px">
                <h3>Regulation & News</h3>
                {{-- <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                    mollit anim id est laborum.</p> --}}
            </div>

        </div>
    </section>


    <section id="#" class="about">
        <div class="container ">
            <div class="row justify-content-end">
                <div class="col-md-4 mb-3">
                    <form action="">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search..."
                                aria-label="Search" value="{{ request('search') }}" aria-describedby="button-addon2">
                            {{-- <button class="badge bg-success border-0" type="submit"><i class="fas fa-search"></i></button> --}}
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @foreach ($regulations as $regulation)
                    <div class="col-lg-12 pt-4 pt-lg-0 content">
                        <h2><a href="/news/{{ $regulation->id }}"><strong>{{ $regulation->title }}</strong></a></h2>
                        <p><strong>{{ $regulation->type }}</strong></p>
                        <p class="text-break">
                            {!! \Illuminate\Support\Str::limit($regulation->content, 299, $end = '...') !!}
                            <br>
                            <small>
                                <strong> Update at</strong> :
                                {{ date('d M Y', $regulation->created_at->timestamp) }}
                            </small>
                        </p>

                        <hr>
                    </div>
                @endforeach
            </div>

        </div>
    </section><!-- End About Us Section -->
@endsection
