        <nav class="navbar-lowprices4u navbar-expand-md">
            <div class="container">
                <button class="navbar-toggler dropbtn" type="button" data-toggle="collapse" data-target="#navbarSC" aria-controls="navbarSC" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <i class="fas fa-bars fa-2x"></i>
                </button>
    
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-tags navbar-logo"></i>
                    {{ config('app.name', 'LowPrices4u') }}
                </a>
                <div class="collapse navbar-collapse" id="navbarSC">
                    
                    <!-- Left Side Of Navbar -->
                    <div class="search-form">
                        @include('inc.search-form')
                    </div>

                    <!-- Right Side Of Navbar -->
                    <div class="user-div">
                        <!-- Authentication Links -->
                        @guest
                            <div class="dropdown">
                                <div id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="far fa-user fa-2x user-icon"></span>
                                </div>
                            
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                </div>
                            </div>
                        @else
                        <div class="dropdown">
                            <div id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="far fa-user fa-2x user-icon"></span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <a class="nav-link" href="/my-account">
                                    {{-- Auth::user()->name --}} 
                                    My Account
                                </a>
                            </li>

                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            
                        @endguest
                    </div>
                        </div>
                </div>
            </div>
        </nav>