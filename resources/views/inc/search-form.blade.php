
{!! Form::open(['url' => '/results', 'method'=>'GET']) !!}
<div class="input-group">
    {!! Form::text('q', Request::get('q'), ['id'=>'sq','class'=>'form-control form-control-lg', 'placeholder'=>'Search for products','aria-label'=>'search', 'aria-describedby'=>'search-form']) !!}
    <div class="input-group-append">
        <button class="btn btn-success" type="submit" id="search-form"><i class="fas fa-search fa-lg"></i></button>
    </div>
</div>
{!! Form::close() !!}