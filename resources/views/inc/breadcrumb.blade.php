
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        
        @if(Request::is('c/*'))
        <li class="breadcrumb-item"><a  class="text-dark" href="/">Home</a></li>
        {{ makeBreadCrumb($category->id)}}
        @endif

        @if(Request::is('compare/*/prices'))
        <li class="breadcrumb-item"><a  class="text-dark" href="/">Home</a></li>
        {{ makeBreadCrumb($product->category_id)}}
        <li class="breadcrumb-item active" aria-current="page">{!!$product->title!!}</li>
        @endif
    </ol>
</nav>