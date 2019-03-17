<a  class="text-muted" :href="'/compare/'+product.slug+'/prices'">
    <div class="card w-100" >
        
        @if(Request::is('retailer/*'))
            <img v-if="product.images" :src="'/'+product.images[0].path" class="card-img-top" :alt="product.title" id="'prod_image_'+product.id" >
            
        @else
            <img v-if="product.images" :src="'/'+product.images.path" class="card-img-top" :alt="product.title" id="'prod_image_'+product.id" >
        @endif
        <img v-else src="https://via.placeholder.com/200" class="card-img-top" alt="no-image">
        <div class="card-body">
            <h6 class="lead"> <small>@{{product.title.substring(0,40)+".."}}</small> </h6>
            <p class="card-title h3 "><small class="h6">from</small> <em class="text-success">£@{{product.min_price}}</em></p>
            
            <button class="btn btn-success btn-block">Compare prices </button>
        </div>
    </div>
</a>