@extends('layouts.app')
@section('title', $category->title)
@section('content')

<div class="container">
    @include('inc.breadcrumb')
<h1 class="category-title text-muted">{{ $category->title }}</h1>
<div class="hr mb-3"></div>
<input type="hidden" id="catId" value="{{$category->id}}">
    <div class="row mb-2">
        @foreach (App\Category::where('parent_id', $category->id)->get() as $child)
            <div class="col-md-1"> <a href="/c/{{$child->slug}}"><small class="text-secondary">{{ $child->title }}</small></a></div>
        @endforeach
    </div>

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
    
    <script type="text/javascript">
    
        new Vue({
        el: '#products',
        data () {
            return {
            products: null,
            catId: null,
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
            let catId = document.getElementById('catId').value;
            let baseURL = '/api/products/'+catId;
            let pg = 1;
            axios
            .get(baseURL+'?page='+pg)
            .then(response => {
                this.products = response.data.data,
                this.pagination = response.data;
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
            let baseURL = '/api/products/'+this.catId;
			axios.get(val)
				.then(response => {
                    this.products = response.data.data,
                    this.pagination = response.data
				});
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