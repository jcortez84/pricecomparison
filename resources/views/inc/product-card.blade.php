<a  class="card-link" :href="'/compare/'+product.slug+'/prices'">
    <div class="card w-100 b-0 rounded-0 card-card" >
        
        @if(Request::is('retailer/*'))
            <img v-if="product.images" :src="'/'+product.images[0].path" class="card-img-top rounded-0" :alt="product.title" id="'prod_image_'+product.id" >
            
        @else
            <img v-if="product.images" :src="'/'+product.images.path" class="card-img-top rounded-0" :alt="product.title" id="'prod_image_'+product.id" >
        @endif
        <img v-else src="https://via.placeholder.com/200x150" class="card-img-top rounded-0" alt="no-image">
        <div class="card-body">
            <h6> <small>@{{product.title.substring(0,100)+" ..."}}</small> </h6>
            <p class="card-title h3 "><small class="h6">from</small> <em class="text-pink">£@{{product.min_price}}</em></p>
        </div>
    </div>
</a>