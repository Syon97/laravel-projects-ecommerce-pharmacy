<div>
    <div class="py-3 py-md-5">
        <div class="container">

            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)
                        {{-- <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img"> --}}
                        <div class="exzoom" id="exzoom">
                            
                            <!-- Images -->
                            <div class="exzoom_img_box">
                              <ul class='exzoom_img_ul'>
                                @foreach ($product->productImages as $itemImg)
                                    <li><img src="{{ asset($itemImg->image) }}"/></li>
                                @endforeach
                              </ul>
                            </div>

                            <div class="exzoom_nav"></div>
                            <!-- Nav Buttons -->
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                          </div>
                        @else
                            No image added
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $product->category->name }} / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price">RM {{ $product->selling_price }}.00</span>
                            <span class="original-price">RM {{ $product->original_price }}.00</span>
                        </div>
                        <div>
                            @if ($product->quantity > 0)
                                <label class="btn btn-sm py-1 mt-1 text-white bg-success">In Stock</label>
                            @else
                                <label class="btn btn-sm py-1 mt-1 text-white bg-danger">Out of Stock</label>
                            @endif
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}" class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">

                            <button type="button" wire:click="addToCart({{ $product->id }})" class="btn btn1"> 
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>

                            <button type="button" wire:click="addToWishList({{ $product->id }})" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishList">
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addToWishList">Adding...</span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {!! $product->small_description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!! $product->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Related products --}}
    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>
                        Related
                        @if($category) {{ $category->name }} @endif
                        Products
                    </h3>
                    <div class="underline"></div>
                </div>

                <div class="col-md-12">
                    @if ($category)
                    <div class="owl-carousel owl-theme four-carousel">
                        @foreach ($category->relatedProducts as $relatedProductItem)
                        <div class="item mb-3">
                            <div class="product-card">
                            <div class="product-card-img">
                                @if ($relatedProductItem->productImages->count() > 0)
                                <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                    <img src="{{ asset($relatedProductItem->productImages[0]->image) }}" alt="{{ $relatedProductItem->name }}">
                                </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                <h5 class="product-name">
                                    <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                            {{ $relatedProductItem->name }} 
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">RM {{ $relatedProductItem->selling_price }}.00</span>
                                    <span class="original-price">RM {{ $relatedProductItem->original_price }}.00</span>
                                </div>
                            </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                        <div class="p-2">
                            <h4>No Related Products Available</h4>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- Related brands/product --}}
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>
                        Related
                        @if($product) {{ $product->brand }} @endif
                        Products
                    </h3>
                    <div class="underline"></div>
                </div>

                <div class="col-md-12">
                    @if ($category)
                    <div class="owl-carousel owl-theme four-carousel">
                        @foreach ($category->relatedProducts as $relatedProductItem)
                            @if ($relatedProductItem->brand == "$product->brand")
                            <div class="item mb-3">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        @if ($relatedProductItem->productImages->count() > 0)
                                        <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                            <img src="{{ asset($relatedProductItem->productImages[0]->image) }}" alt="{{ $relatedProductItem->name }}">
                                        </a>
                                        @endif
                                    </div>
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                        <h5 class="product-name">
                                            <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                                    {{ $relatedProductItem->name }} 
                                            </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">RM {{ $relatedProductItem->selling_price }}.00</span>
                                            <span class="original-price">RM {{ $relatedProductItem->original_price }}.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @else
                        <div class="p-2">
                            <h4>No Related Products Available</h4>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

</div>


@push('scripts')

<script>
    $(function(){

        $("#exzoom").exzoom({

            // thumbnail nav options
            "navWidth": 60,
            "navHeight": 60,
            "navItemNum": 5,
            "navItemMargin": 7,
            "navBorder": 1,

            // autoplay
            "autoPlay": false,

            // autoplay interval in milliseconds
            "autoPlayTimeout": 2000
        });
    });

    $('.four-carousel').owlCarousel({
    loop:false,
    margin:10,
    dots:true,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
});
</script>
    
@endpush
