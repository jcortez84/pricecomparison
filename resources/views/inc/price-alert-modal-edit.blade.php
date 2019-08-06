
    <!-- Modal -->
    {!! Form::open(['url' => '/update-price-alert', 'method'=>'POST']) !!}
      <div class="modal fade" id="priceAlertModal_{{$alert->product_id}}" tabindex="-1" role="dialog" aria-labelledby="priceAlertModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content rounded-0">
            <div class="modal-header">
              <h4 class="small modal-title text-muted text-uppercase" id="priceAlertModalTitle">Edit Price Alert</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body row">
              <div class="col-6">
                  <div class="col-auto">
                      <label class="modal-title text-muted small text-uppercase" for="target_price">1. Set target price</label>
                      <div class="input-group mb-2 mt-5">
                        <div class="input-group-prepend">
                          <div class="input-group-text rounded-0"><em class="text-teal">£</em></div>
                        </div>
                      <input name="target_price" value="{{ $alert->target_price }}" type="number" class="form-control text-teal font-weight-bold font-italic" id="target_price" pattern="[0-9]+([\.,][0-9]+)?" step="0.01">
                        <div class="col-12">
                          <p class="mt-2"><span class="text-muted small uppercase">Current price:</span> <em class="text-pink ">£{{App\Product::where('id', $alert->product_id)->first()->min_price}}</em></p>
                        </div>
                      </div>
                    </div>
              </div>
              <div class="col-6">
                  <img src="/{{App\ProductImage::where('product_id', $alert->product_id)->first()->path}}" class="alert-image">
                  <span class="small mt-2 text-teal" v-html="product.title"></span>
                </div>
                <div class="form-group col-12 mt-2">
                    <label class="text-muted modal-title  small text-uppercase" for="email_alert">2. Enter your email address</label>
                    @guest
                      <input name="email" type="email" class="form-control text-muted rounded-0" id="email_alert" placeholder="name@email.com">
                    @else
                      <input name="email" type="email" class="form-control text-muted rounded-0" id="email_alert" value="{{Auth::user()->email}}">
                    @endguest
                    <input type="hidden" name="product_id" value="{{$alert->product_id}}" id="product_id">
                  </div>
            </div>
            
            <div class="modal-footer">
              <button type="submit" class="btn btn-go btn-block rounded-0" >Update price alert</button>
              
            </div>
            <p class="container small text-muted">I agree that lowprices4u.co.uk will inform me of special shop offers and services. I can withdraw my consent to this at any time, as outlined in the <a href="/page/privacy">Privacy Policy</a>.</p>
          </div>
        </div>
      </div>
      {!! Form::close() !!}