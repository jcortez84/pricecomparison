@extends('layouts.admin')
@section('title', 'Save Datafeed Settings')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Save Datafeed Settings</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
              
          </div>
        </div>
      </div>
      <div class="container">
        {!! Form::open(['action' => ['Admin\DatafeedsController@testCreate', Request::segment(3) ], 'method' => 'POST']) !!}
        <div style="overflow-x:auto;">
            <table class="table-bordered">
              <tr>
                @foreach ($params[0] as $numcol)
                      <th>{{ $numcol }}</th>
                @endforeach
              </tr>
              <tr>
                @foreach ($params[0] as $key => $item)
                <td>
                  <select id="sel1" name="params[]">
                      <option value="">Select </option>
                      <option <?=($feed->column_name === $key)?'selected':''?> value="productName">Product Name</option>
                      <option <?=($feed->column_description === $key)?'selected':''?> value="productDesc">Product Description</option>
                      <option <?=($feed->column_price === $key)?'selected':''?> value="productPrice">Product Price</option>
                      <option <?=($feed->column_category_name === $key)?'selected':''?> value="categoryName">Category Name</option>
                      <option <?=($feed->column_category_id === $key)?'selected':''?> value="categoryId">Category ID</option>
                      <option <?=($feed->column_shipping === $key)?'selected':''?> value="shipping">Shipping</option>
                      <option <?=($feed->column_buy_url === $key)?'selected':''?> value="buyUrl">Buy URL</option>
                      <option <?=($feed->column_promo === $key)?'selected':''?> value="promoText">Promo Text</option>
                      <option <?=($feed->column_mpn === $key)?'selected':''?> value="mpn">MPN</option>
                      <option <?=($feed->column_upc === $key)?'selected':''?> value="upc">UPC</option>
                      <option <?=($feed->column_isbn === $key)?'selected':''?> value="isbn">ISBN</option>
                      <option <?=($feed->column_ean === $key)?'selected':''?> value="ean">EAN</option>
                      <option <?=($feed->column_image_url === $key)?'selected':''?> value="image">Image</option>
                      <option <?=($feed->column_brand === $key)?'selected':''?> value="brand">Brand</option>
                    </select>
                  </td>
                  @endforeach
                </tr>
                  
                  @for($i=1; $i<10; $i++)
                  <tr>
                    @foreach ($params[$i] as $item)
                        <td> {{ str_limit($item, 30, '...') }}</td>
                    @endforeach
                  </tr>
                  @endfor
              
            </table>
          </div>
        <div class="form-group">
          {!! Form::label('Match By:') !!}
          {!! Form::select('match_by', ['mpn'=>'MPN', 'gtin'=>'GTIN', 'ean'=>'EAN', 'isbn'=>'ISBN', 'upc'=>'UPC', 'name'=>'Product Name'],null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Add New Products:') !!}
          {!! Form::select('add_new_products', ['0'=>'No', '1'=>'Yes'],null, ['class' => 'form-control']) !!}
          <p>Select Yes if you want to add products to database if not found.</p>
        </div>

        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection