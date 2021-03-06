<div class="mobile-menu container-fluid " id="navbarSC">
  <div class="container">
    <nav class="nav-menu">
      <div class="navbar">
        <ul class="nav-menu-ul">


          @foreach(App\Category::where('is_featured', '1')->take(9)->get() as $category )
          <li class="nav-menu-btn">

            <a class="btn-purple text-uppercase nav-a" id="dropdown{{$category->id}}" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false"><span class="cat-title">{{$category->title}}</span></a>

            <div class="dropdown-menu megamenu rounded-0" aria-labelledby="dropdown{{$category->id}}">
              <div class="row">
                @foreach (App\Category::where('parent_id', $category->id)->get() as $child)
                <div class="col-sm-12 col-lg-3">
                  <a class="dropdown-item text-uppercase text-muted" href="/c/{{$child->slug}}">
                    <h5 class="h4"><small>{{$child->title}}</small></h5>
                  </a>
                  @foreach (App\Category::where('parent_id', $child->id)->get() as $grand_child)
                  <a class="dropdown-item nav-link text-muted"
                    href="/c/{{$grand_child->slug}}">{{ $grand_child->title }}</a>
                  @endforeach
                </div>
                @endforeach
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </nav>
  </div>
</div>