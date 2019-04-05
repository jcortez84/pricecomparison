@extends('layouts.app')
@section('title', $retailer->name)
@section('content')
<div class="container">
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark" href="/">Home</a></li>
                <li class="breadcrumb-item"><a class="text-dark" href="/retailers">Retailers</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$retailer->name}} Products</li>
        </ol>
</nav>       
<h1 class="h2 text-success">{{$retailer->name}} Products</h1>
<input type="hidden" id="mId" value="{{$retailer->id}}">
<div id="retailer_products">
                <section v-if="errored">
                        <p>We're sorry, we're not able to retrieve this information at the moment, please try back later</p>
                </section>
                <section v-else class="row">
                        <div v-if="loading" class="spinner-border text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                        </div>
                
                        <div v-for="product in products" class="col-6 col-sm-6 col-md-3 d-inline mb-3">
                                @include('inc.product-card')
                        </div>
                        {{-- Include the pagination blade template --}}
                        @include('inc.paginate')
                        
                        
                </section>
                </div>
                    
                    <script type="text/javascript">
                    
                        new Vue({
                        el: '#retailer_products',
                        data () {
                            return {
                            products: null,
                            loading: true,
                            errored: false,
                            pagination: null
                            }
                        },
                        filters: {
                            currencydecimal (value) {
                            return value.toFixed(2)
                            }
                        },
                        mounted () {
                                let mId = document.getElementById("mId").value;
                            let baseURL = '/api/retailer-products/'+mId;
                            let pg = 1;
                            axios
                            .get(baseURL+'?page='+pg)
                            .then(response => {
                                this.products = response.data.data,
                                this.pagination = response.data
                            })
                            .catch(error => {
                                console.log(error)
                                this.errored = true
                            })
                            .finally(() => this.loading = false)
                        },
                        methods: {
                                // Our method to GET results from a Laravel endpoint
                                getResults(val) {
                                        let mId = document.getElementById("mId").value;
                                        let baseURL = '/api/retailer-products/'+mId;
                                        axios.get(val)
                                                .then(response => {
                                    this.products = response.data.data,
                                    this.pagination = response.data
                                                });
                                }
                        }
                        });
                    </script> 
</div>
@endsection