<div class="mobile-search">
{!! Form::open(['url' => '/results', 'method'=>'GET']) !!}
<div class="input-group">
    {!! Form::text('q', Request::get('q'), ['id'=>'sq','class'=>'form-control form-control-lg search-input rounded-0 text-muted', 'placeholder'=>'Search for products...','aria-label'=>'search', 'aria-describedby'=>'search-form']) !!}
</div>
{!! Form::close() !!}
</div>