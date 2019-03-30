@extends('layouts.app')
@section('title', 'Compare prices - Lowprices4u.co.uk')
@section('content')
<div class="container">
<div id="deals">
        <div class="header h2 text-success mt-4">Featured products</div>
        <div  class="row">
            <div v-for="product in feats" class="col-md-3 d-inline mb-3" >
                    @include('inc.product-card')
            </div>
        </div>
        <div class="header h2 text-success mt-2">Top deals</div>
        <div  class="row">
            <div v-for="product in deals" class="col-md-3 d-inline mb-3" >
                    @include('inc.product-card')
            </div>
        </div>

</div>
    
 

    <script type="text/javascript">
    
        new Vue({
        el: '#deals',
        data () {
            return {
            deals: null,
            feats: null,
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
            let topProds = '/api/top-products';
            let featProds = '/api/feat-products';
            axios.all([
                axios.get(topProds),
                axios.get(featProds)
            ])
            .then(axios.spread((topProdsRes, featProdsRes) => {
                this.deals = topProdsRes.data,
                this.feats = featProdsRes.data
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
