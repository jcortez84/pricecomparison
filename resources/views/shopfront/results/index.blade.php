@extends('layouts.app')
@section('title', 'Compare '.Request::get('q').' prices')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Search results</li>
        </ol>
    </nav>
<h1 class="h2 text-success">Search Results</h1>
@if(Request::get('q'))
<div id="products">
        
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
@else
<p class="mx-auto">You did not submit a valid search string. <br>Please try again!</p>
@endif

</div>
<script type="text/javascript">

    new Vue({
    el: '#products',
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
        let q = document.getElementById("sq").value;
        let baseURL = '/api/search/'+q;
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
        let q = document.getElementById("sq").value;
        let baseURL = '/api/search/'+q;
        axios.get(val)
            .then(response => {
                this.products = response.data.data,
                this.pagination = response.data
            });
    }
}
    });
</script>
@endsection
