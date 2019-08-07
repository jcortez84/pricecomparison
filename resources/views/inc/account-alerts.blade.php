<h3 class="h4 text-teal mt-3 text-uppercase">Price Alerts</h3>


<table class="table">
        <thead>
          <tr>
            <th scope="col">Product Id</th>
            <th scope="col">Product Name</th>
            <th scope="col">Current Price</th>
            <th scope="col">Target Price</th>
            <th scope="col-2"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ( App\Alert::where('email', Auth::user()->email )->orderBy('created_at', 'DESC')->get() as $alert)
                <tr>
                    <th scope="row">{{$alert->id}}</th>
                    <td class="text-muted">{{ App\Product::where('id', $alert->product_id)->first()->title }}</td>
                    <td class="text-pink h5">£{{ App\Product::where('id', $alert->product_id)->first()->min_price }}</td>
                    <td class="text-teal h5">£{{$alert->target_price}}</td>
                    <td class="text-teal h5">
                      <button class="btn btn-teal-outline rounded-0" data-toggle="modal" data-target="#priceAlertModal_{{$alert->product_id}}"><span class="fas fa-edit"></span></button>
                      <button class="btn btn-outline-danger rounded-0"><span class="fas fa-trash"></span></button>
                    </td>
                    
                </tr>
                @include('inc.price-alert-modal-edit')
            @endforeach
            
        </tbody>
      </table>

