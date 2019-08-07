<div class="search-form">
{!! Form::open(['url' => '/results', 'method'=>'GET']) !!}
<div class="input-group">
    {!! Form::text('q', Request::get('q'), ['id'=>'sq','class'=>'form-control form-control-lg search-input rounded-0 text-muted', 'placeholder'=>'Search for products...','aria-label'=>'search', 'aria-describedby'=>'search-form']) !!}
    <div class="input-group-append">
        <button class="btn btn-teal-search rounded-0" type="submit" id="search-form"><i class="fas fa-search fa-lg"></i></button>
    </div>
</div>
{!! Form::close() !!}
</div>