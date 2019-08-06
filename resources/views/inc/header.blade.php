<nav class="navbar-lowprices4u navbar-expand-md navbar">
    <div class="container">
        <button class="navbar-toggler dropbtn b-0" type="button" data-toggle="collapse" data-target="#navbarSC" aria-controls="navbarSC" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fas fa-bars fa-2x text-white"></i>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fa fa-tags navbar-logo"></i>
                    {{ config('app.name', 'LowPrices4u') }}
        </a>
        <div class="collapse navbar-collapse" id="navbarSC">
            <!-- Left Side Of Navbar -->
            @include('inc.search-form')
            
            @include('inc.header-auth')
            
        </div>
    </div>
</nav>