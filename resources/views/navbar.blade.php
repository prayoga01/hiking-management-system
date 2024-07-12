<div class="container d-flex align-items-center justify-content-between">

    <div class="logo">
        <h1 class="text-light"><a href="/"><span>MountainMate</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
    </div>

    <nav id="navbar" class="navbar">
        @if (Route::has('login'))
            <div class="sm:fixed">
                @auth
                    <ul>
                        <li><a class="nav-link scrollto" href="/">Home</a></li>
                        <li><a class="nav-link scrollto" href="/news">News & Regulation</a></li>
                        <li><a class="nav-link scrollto" href="/reservations">Transaction</a></li>
                        <li class="dropdown"><a href="#"><span>{{ auth()->user()->name }}</span> <i
                                    class="fa-solid fa-user"></i></a>
                            <ul>
                                <li><a href="#">Profile</a></li>
                                <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LogOut</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>

                            </ul>
                        </li>
                    </ul>
                @else
                    <ul>
                        <li><a class="nav-link scrollto" href="/">Home</a></li>
                        <li><a class="nav-link scrollto" href="/news">News & Regulation</a></li>
                        <li><a class="nav-link scrollto" href="/reservations">Transaction</a></li>
                        <li><a class="nav-link scrollto" href="{{ route('login') }}">Login <i
                                    class="fa-solid fa-user"></i></a></li>
                    </ul>
                @endauth
            </div>
        @endif

    </nav><!-- .navbar -->

</div>
