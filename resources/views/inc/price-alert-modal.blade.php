
    <!-- Modal -->
    {!! Form::open(['url' => '/set-price-alert', 'method'=>'POST']) !!}
    {{-- <form  id="price-alert-form" method="POST" action="/set-price-alert"> --}}
      <div class="modal fade" id="priceAlertModal" tabindex="-1" role="dialog" aria-labelledby="priceAlertModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-muted" id="priceAlertModalTitle">Set up Price Alert</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body row">
              <div class="col-6">
                  <div class="col-auto">
                      <label class="modal-title text-muted h5" for="target_price">1. Select target price</label>
                      <div class="input-group mb-2 mt-5">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><em class="text-success">£</em></div>
                        </div>
                        <input name="target_price" :value="(product.min_price - (product.min_price * 0.05)).toFixed(2)" type="number" class="form-control text-success font-weight-bold font-italic" id="target_price" pattern="[0-9]+([\.,][0-9]+)?" step="0.01">
                        <div class="col-12">
                          <p class="mt-2"><span class="text-muted small uppercase">Current price:</span> <em class="text-success ">£@{{formatPrice(product.min_price)}}</em></p>
                        </div>
                      </div>
                    </div>
              </div>
              <div class="col-6">
                  <img :src="'/'+product.images.path" class="img-thumbnail">
                  <span class="small mt-2 text-success font-weight-bold" v-html="product.title"></span>
                </div>
                <div class="form-group col-12 mt-2">
                    <label class="text-muted modal-title h5 mt-2" for="email_alert">2. Enter your email address</label>
                    <input name="email" type="email" class="form-control text-muted" id="email_alert" placeholder="name@example.com">
                    <input type="hidden" name="product_id" value="{{$product->id}}" id="product_id">
                  </div>
            </div>
            
            <div class="modal-footer">
              <button type="submit" class="btn btn-success btn-block" >Activate price alert</button>
              
            </div>
            <p class="container small text-muted">I agree that lowprices4u.co.uk will inform me of special shop offers and services. I can withdraw my consent to this at any time, as outlined in the <a href="/page/privacy">Privacy Policy</a>.</p>
          </div>
        </div>
      </div>
      {!! Form::close() !!}