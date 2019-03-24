@if(isset($categories))
  <div class="container-fluid bg-success">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light bg-success p-1">
          <div class="collapse navbar-collapse" id="navbarSC">
            <ul class="navbar-nav  mx-auto" >
              <span class="border-right p-2"></span>
              <span class="border-right"></span>
              @foreach($categories as $category )
              <li class="pt-0 nav-item dropdown megamenu-li">

                <a class="btn-success text-uppercase text-white px-1" id="dropdown{{$category->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span style="font-size:10px; font-weight:900">{{$category->title}}</span></a>
                <span class="border-right"></span>
                  <div class="dropdown-menu megamenu" aria-labelledby="dropdown{{$category->id}}">
                    <div class="row">
                      @foreach (App\Category::where('parent_id', $category->id)->get() as $child)
                        <div class="col-sm-12 col-lg-3">
                          <a class="dropdown-item text-uppercase text-success" href="/c/{{$child->slug}}"><h5 class="h4"><small style="font-size:13px; font-weight:900">{{$child->title}}</small></h5></a>
                            @foreach (App\Category::where('parent_id', $child->id)->get() as $grand_child)
                              <a class="dropdown-item nav-link pl-3 pt-0 pb-0" href="/c/{{$grand_child->slug}}"><small style="font-size:12px; font-weight:600">{{ $grand_child->title }}</small></a>
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
    </div>
@endif