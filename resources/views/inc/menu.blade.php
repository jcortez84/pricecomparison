<div class="container-fluid bg-teal p-0 mb-0">
    <div class="container bg-teal p-0">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-md navbar-light bg-teal nav-menu p-0">
                   <div class="collapse navbar-collapse" id="navbarSC" style="height:100%">
                        <ul class="navbar-nav nav-menu-ul">
                            @foreach(App\Category::where('is_featured', 1)->take(9)->get() as $category )
                            <li class="nav-menu-btn">
                                <a class="btn-menu text-uppercase nav-a" id="dropdown{{$category->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small>{{$category->title}}</small></a>
                                <div class="dropdown-menu megamenu rounded-0" aria-labelledby="dropdown{{$category->id}}">
                                    <div class="row">
                                        @foreach (App\Category::where('parent_id', $category->id)->get() as $child)
                                            <div class="col-md-4 col-lg-3">
                                                <a  class="dropdown-item text-uppercase text-teal" href="/c/{{$child->slug}}"><span class="text-teal">{{$child->title}}</span></a>
                                                    @foreach (App\Category::where('parent_id', $child->id)->get() as $grand_child)
                                                    <a class="dropdown-item nav-link" href="/c/{{$grand_child->slug}}"><span class="text-pink ml-3">--- </span>{{ $grand_child->title }}</a>
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
</div>