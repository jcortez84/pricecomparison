@extends('layouts.app')
@section('title', $product->title)
@section('content')
<div class="container">
    @include('inc.breadcrumb')
    <input type="hidden" id="prod_id" value="{{$product->id}}">
    <div id="product">
        <section v-if="errored">
            <p>We're sorry, we're not able to retrieve this information at the moment, please try back later</p>
        </section>
        <section v-else>
            <div class="mx-auto" v-if="loading">
                <div class="spinner-border text-secondary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 col-lg-4">
                    <img v-if="product.images.path !== null" :src="'/'+product.images.path" class="product-img-main"
                        :alt="product.title" id="prod_image">
                    <img v-else src="https://via.placeholder.com/200" class="product-img-main" alt="no-image">
                </div>
                <div class="col-md-6 col-lg-8">
                    <h1 class="product-name text-muted" v-html="product.title">@{{product.title}}</h1>
                    <p v-if="product.description" class="lead text-muted"><small
                            v-html="product.description.substring(0,150)+'...'"></small></p>
                    <p class="lead text-muted"><small>Lowest price:</small> <em
                            class="h2 text-pink">£@{{formatPrice(product.min_price)}}</em>&nbsp;&nbsp;
                        <sup class="btn btn-outline-secondary btn-sm rounded-0" data-toggle="modal"
                            data-target="#priceAlertModal">
                            <i class="far fa-bell text-teal"></i> Price alert
                        </sup>
                    </p>

                </div>
                @include('inc.price-alert-modal')

            </div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active rounded-0" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                        role="tab" aria-controls="nav-home" aria-selected="true">Compare Prices</a>
                    <a class="nav-item nav-link rounded-0" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                        role="tab" aria-controls="nav-profile" aria-selected="false">Product Information</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div v-if="prices" v-for="price in prices" class="row mb-0">
                        <div class="card-body p-0 row mb-0">

                            <div class="col-md-2 col-3">
                                <img class="price-logo" v-if="price.logo" v-bind:src="price.logo">
                                <h6 class="text-muted small"> @{{price.name}}</h6>
                            </div>
                            <div class="col-md-4 col-9">
                                <span class="text-muted mx-auto"> @{{price.product_title}}</span>
                            </div>
                            <div class="col-md-3 col-6">
                                <h3 class="text-muted"><em class="text-pink">£@{{formatPrice(price.amount)}}</em></h3>
                                <p class="text-muted small">
                                    £@{{ formatPrice(Number(price.amount) + Number(price.shipping)) }} Incl.
                                    delivery<br>
                                    <em class="small text-danger">* Updated at: @{{price.updated_at}}</em>
                                </p>

                            </div>
                            <div class="col-md-2 col-6">
                                <a v-bind:href="'/gotostore/'+ price.id +'?task=bhsafg272bygv21rigkvby4gfvob'"
                                    target="_blank">
                                    <button class="btn btn-teal-outline btn-lg rounded-0">Go to store</button>
                                </a>
                            </div>
                        </div>
                        <hr class="alert-light col-12">
                    </div>
                </div>
                <div class="tab-pane fade p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                    v-html="product.description"></div>
            </div>
        </section>
    </div>

    <script type="text/javascript">
        new Vue({
                    el: '#product',
                    data () {
                        return {
                        product: null,
                        prices: null,
                        images: null,
                        loading: true,
                        errored: false,
                        altImage : "https://via.placeholder.com/200"
                        }
                    },
                    filters: {
                        currencydecimal (value) {
                        return value.toFixed(2)
                        }
                    },
                    mounted () {
                        let prod_id = document.getElementById("prod_id").value;
                        axios
                        .get('/api/product/'+prod_id)
                        .then(response => {
                            this.product = response.data;
                            return axios.get('/api/prices/'+prod_id);
                        }).then(response => {
                                this.prices = response.data;
                                return axios.get('/api/product-images/'+prod_id);
                        }).then(response => {
                            this.images = response.data;
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = false)
                    },
                    methods: {
                        formatPrice(value) {
                        let val = (value/1).toFixed(2).replace('.', '.')
                        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
                        },
                        imageLoadError () {
                            document.getElementById('prod_image').src='https://via.placeholder.com/200';
                        console.log('Image failed to load');
                        }
                    }
                    });


    </script>
</div>
@endsection