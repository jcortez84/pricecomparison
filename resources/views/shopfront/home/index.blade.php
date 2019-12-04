@extends('layouts.app')
@section('title', 'Price Comparison - Lowprices4u.co.uk')
@section('content')
{{-- @include('inc.carousel') --}}
<div class="container">
    <div id="deals">
        <div class="text-muted mt-1 text-uppercase"><small class="section-title">Popular Products</small></div>
        <div class="scrolling-wrapper">
            <div v-for="product in popular_products" class="card m-1">
                @include('inc.product-card')
            </div>
        </div>
        <div class="text-muted mt-3 text-uppercase"><small class="section-title">Top
                Deals</small></div>
        <div class="scrolling-wrapper">
            <div v-for="product in top_deals" class="card m-1">
                @include('inc.product-card')
            </div>
        </div>
        <div class="text-muted mt-3 text-uppercase"><small class="section-title">Electronics</small></div>
        <div class="scrolling-wrapper">
            <div v-for="product in electronics" class="card m-1">
                @include('inc.product-card')
            </div>
        </div>
        <div class="text-muted mt-3 text-uppercase"><small class="section-title">Health & Beauty</small></div>
        <div class="scrolling-wrapper">
            <div v-for="product in health" class="card m-1">
                @include('inc.product-card')
            </div>
        </div>
        <div class="text-muted mt-3 text-uppercase"><small class="section-title">Home Appliances</small></div>
        <div class="scrolling-wrapper">
            <div v-for="product in appliances" class="card m-1">
                @include('inc.product-card')
            </div>
        </div>
        <div class="text-muted mt-3 text-uppercase"><small class="section-title">Home & Garden</small></div>
        <div class="scrolling-wrapper">
            <div v-for="product in garden" class="card m-1">
                @include('inc.product-card')
            </div>
        </div>
        <div class="text-muted mt-3 text-uppercase"><small class="section-title">Computers & Software</small></div>
        <div class="scrolling-wrapper">
            <div v-for="product in computers" class="card m-1">
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
            electronics: null,
            health:null,
            appliances:null,
            garden:null,
            computers:null,
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
            let electronics = '/api/category-prods/4';
            let health = '/api/category-prods/99';
            let appliances = '/api/category-prods/361';
            let garden = '/api/category-prods/421';
            let computers = '/api/category-prods/61';
            axios.all([
                axios.get(popular_products),
                axios.get(top_deals),
                axios.get(electronics),
                axios.get(health),
                axios.get(appliances),
                axios.get(garden),
                axios.get(computers),
            ])
            .then(axios.spread((res1,res2,res3,res4,res5,res6,res7) => {
                this.popular_products = res1.data,
                this.top_deals = res2.data,
                this.electronics = res3.data.
                this.health = res4.data,
                this.appliances = res5.data,
                this.garden = res6.data,
                this.computers = res7.data
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