@extends('layouts.app')
@section('title', 'Price Comparison - Lowprices4u.co.uk')
@section('content')
@include('inc.carousel')
<div class="container">
    <div id="deals">
        <div class="text-muted mt-1 text-uppercase"><small class="section-title">Popular Products</small></div>
        <div  class="row mt-3">
            <div v-for="product in popular_products" class="col-6 col-sm-6 col-md-3 d-inline mb-3 card-group" >
                @include('inc.product-card')
            </div>
        </div>
        <div class="text-muted mt-3 text-uppercase"><small class="section-title">Top Deals</small></div>
        <div  class="row mt-3">
            <div v-for="product in top_deals" class="col-6 col-sm-6 col-md-3 d-inline mb-3" >
                @include('inc.product-card')
            </div>
        </div>
    </div>

</div>
    
 

    <script type="text/javascript">
    
        new Vue({
        el: '#deals',
        data () {
            return {
            popular_products: null,
            top_deals: null,
            loading: true,
            errored: false
            }
        },
        filters: {
            currencydecimal (value) {
            return value.toFixed(2)
            }
        },
        mounted () {
            let popular_products = '/api/top-products';
            let top_deals = '/api/top-deals';
            axios.all([
                axios.get(popular_products),
                axios.get(top_deals)
            ])
            .then(axios.spread((Res1,Res2) => {
                this.popular_products = Res1.data,
                this.top_deals = Res2.data
            }))
            .catch(error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => this.loading = false)
        },
        imageLoadError () {
            document.getElementById('prod_image_'+this.id).src='https://via.placeholder.com/200';
                console.log('Image failed to load');
        }
        });
    </script>

</div>
@endsection
