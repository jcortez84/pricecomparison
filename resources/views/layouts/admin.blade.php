
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Admin panel</title>

    <!-- Bootstrap core CSS -->
<link href="{{ asset('css/admin/main.css') }}" rel="stylesheet">



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">
  </head>
  <body>
      <form method="get">
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/admin') }}">Admin Panel</a>
      
        <input name="q" class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" value="{{ Request::get('q') }}">
          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <button class="btn btn-info" type="submit">Find</button>
            </li>
          </ul>
      
    </nav>
  </form>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin')?'active':'' }}" href="{{ url('/admin') }}">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/merchants') || Request::is('admin/merchants/*') || Request::is('admin/merchants-csv')?'active':'' }}" href="{{ url('/admin/merchants') }}">
              <span data-feather="file"></span>
              Merchants
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/categories-csv') || Request::is('admin/categories') || Request::is('admin/categories/*')?'active':'' }}" href="{{ url('/admin/categories') }}">
              <span data-feather="archive"></span>
              Categories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/products-csv') || Request::is('admin/products') || Request::is('admin/products/*')?'active':'' }}" href="{{ url('/admin/products') }}">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/users') || Request::is('admin/users/*')?'active':'' }}" href="{{ url('/admin/users') }}">
              <span data-feather="users"></span>
              Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/reports') || Request::is('admin/reports/*')?'active':'' }}" href="{{ url('/admin/reports') }}">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/pages') || Request::is('admin/pages/*')?'active':'' }}" href="{{ url('/admin/pages') }}">
              <span data-feather="file"></span>
              Pages
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/images') || Request::is('admin/images/*')?'active':'' }}" href="{{ url('/admin/images') }}">
              <span data-feather="image"></span>
              Images
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/logout') }}">
              <span data-feather="log-out"></span>
              Logout
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Super user</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('admin/migrations') || Request::is('admin/migrations/*')?'active':'' }}" href="{{ url('/admin/migrations') }}">
              <span data-feather="file-text"></span>
              Migrations
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ Request::is('admin/merge-products') || Request::is('admin/merge-products/*')?'active':'' }}" href="{{ url('/admin/merge-products') }}">
              <span data-feather="file-text"></span>
              Merge Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      @include('inc.notifications')
      @yield('content')
    </main>
    @include('inc.delete-modal')
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="{{ asset('js/admin.js') }}"></script></body>
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
        <script>
            $('textarea').ckeditor();
            // $('.textarea').ckeditor(); // if class is prefered.
        </script>
</html>
