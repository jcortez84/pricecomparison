<a class="card-link" :href="'/compare/'+product.slug+'/prices'">
    <div class=" w-100 b-0 rounded-0 card-card">

        @if(Request::is('retailer/*'))
        <img :src="'/'+product.images[0].path" class="card-img-top rounded-0" :alt="product.title"
            id="'prod_image_'+product.id" onError=" this.src='https://via.placeholder.com/200x150/CC0?text=No+image'">

        @else
        <img :src="'/'+product.images.path" class="card-img-top rounded-0" :alt="product.title"
            id="'prod_image_'+product.id" onError="this.src = 'https://via.placeholder.com/200x150/CC0?text=No+image'">
        @endif
        <div class="card-body">
            <h6> <small>@{{product.title.substring(0,100)+" ..."}}</small> </h6>
            <p class="card-title h3 "><small class="h6">from</small> <em class="text-pink">£@{{product.min_price}}</em>
            </p>
        </div>
    </div>
</a>