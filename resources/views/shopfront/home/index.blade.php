@extends('layouts.app')
@section('title', 'Compare prices - Lowprices4u.co.uk')
@section('content')
<div class="container">
<div id="deals">
        <div class="header h2 text-success mt-0">Low price LED TV offers</div>
        <div  class="row">
            <div v-for="product in prods1" class="col-6 col-sm-6 col-md-3 d-inline mb-3" >
                    @include('inc.product-card')
            </div>
        </div>
        <div class="header h2 text-success mt-2">Low price Fridge Freezers</div>
        <div  class="row">
            <div v-for="product in prods2" class="col-6 col-sm-6 col-md-3 d-inline mb-3" >
                    @include('inc.product-card')
            </div>
        </div>
        <div class="header h2 text-success mt-2">Low price Perfumes</div>
        <div  class="row">
            <div v-for="product in prods3" class="col-6 col-sm-6 col-md-3 d-inline mb-3" >
                    @include('inc.product-card')
            </div>
        </div>
        <div class="header h2 text-success mt-2">Low price Blu-Ray Players</div>
        <div  class="row">
            <div v-for="product in prods4" class="col-6 col-sm-6 col-md-3 d-inline mb-3" >
                    @include('inc.product-card')
            </div>
        </div>
        <div class="header h2 text-success mt-2">Low price Digital Cameras</div>
        <div  class="row">
            <div v-for="product in prods5" class="col-6 col-sm-6 col-md-3 d-inline mb-3" >
                    @include('inc.product-card')
            </div>
        </div>

</div>
    
 

    <script type="text/javascript">
    
        new Vue({
        el: '#deals',
        data () {
            return {
            prods1: null,
            prods2: null,
            prods3: null,
            prods4: null,
            prods5: null,
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
            let prods1 = '/api/index-products/651';
            let prods2 = '/api/index-products/380';
            let prods3 = '/api/index-products/113';
            let prods4 = '/api/index-products/551';
            let prods5 = '/api/index-products/32';
            axios.all([
                axios.get(prods1),
                axios.get(prods2),
                axios.get(prods3),
                axios.get(prods4),
                axios.get(prods5)
            ])
            .then(axios.spread((Res1,Res2,Res3,Res4,Res5) => {
                this.prods1 = Res1.data,
                this.prods2 = Res2.data,
                this.prods3 = Res3.data,
                this.prods4 = Res4.data,
                this.prods5 = Res5.data
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
