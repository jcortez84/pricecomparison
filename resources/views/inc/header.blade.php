@if(isset($categories))
<div class="container-fluid bg-success">
                <div class="row">
                 <div class="col-12">
                  <nav class="navbar navbar-expand-lg navbar-light bg-success ">
                   <div class="collapse navbar-collapse" id="navbarSC">
                    <ul class="navbar-nav" >
                        @foreach($categories as $category )
                     <li class="nav-item dropdown megamenu-li">
                     <a class="dropdown-toggle text-uppercase text-white p-1" id="dropdown{{$category->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small>{{$category->title}}</small></a>
                      <div class="dropdown-menu megamenu" aria-labelledby="dropdown{{$category->id}}">
                       <div class="row">
                                @foreach (App\Category::where('parent_id', $category->id)->get() as $child)
                                <div class="col-sm-12 col-lg-4">
                                    <a  class="dropdown-item text-uppercase text-success" href="/c/{{$child->slug}}"><h5 class="h4">{{$child->title}}</h5></a>
                                    @foreach (App\Category::where('parent_id', $child->id)->get() as $grand_child)
                                        <a class="dropdown-item nav-link" href="/c/{{$grand_child->slug}}">{{ $grand_child->title }}</a>
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