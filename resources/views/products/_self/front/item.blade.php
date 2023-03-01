<div class="product product-7 text-center">
    <figure class="product-media">
        @if(!$item->isAvailable())
            <span class="product-label label-out">ناموجود</span>
        @elseif($item->isSpecial())
            <span class="product-label label-sale {{--top--}}">فروش ویژه</span>
        @elseif($item->isSuggest())
            <span class="product-label label-new">پیشنهاد شده</span>
        @endif
        <a href="{{ $item->urlShow() }}">
            <img src="{{ $item->file_path }}" alt="{{ $item->name }}"
                class="product-image">
        </a>

        <div class="product-action-vertical">
            <a target="_blank" href="{{ $item->urlShow() }}"
                class="btn-product-icon btn-quickview btn-expandable"
                title="مشاهده سریع محصول"><span>مشاهده</span></a>
            <a href="#"
                class="btn-product-icon btn-wishlist btn-expandable1"><span>افزودن
                    به لیست علاقه مندی</span></a>
            <a href="#" class="btn-product-icon btn-compare btn-expandable1"
                title="مقایسه"><span>مقایسه</span></a>
        </div><!-- End .product-action-vertical -->

        {{-- <div class="product-action">
            <a href="#" class="btn-product btn-cart"><span>افزودن به
                    سبد خرید</span></a>
        </div><!-- End .product-action --> --}}
    </figure><!-- End .product-media -->

    <div class="product-body">
        <div class="product-cat text-center">
            <a href="{{ $item->category->urlShow() }}">{{ $item->category->name ?? '' }}</a>
        </div><!-- End .product-cat -->
        <h3 class="product-title text-center"><a href="{{ $item->urlShow() }}">{{ $item->name }}</a></h3><!-- End .product-title -->
        <div class="product-price">
            {{ number_format($item->price) }} تومان
        </div><!-- End .product-price -->
        <div class="ratings-container">
            <div class="ratings">
                <div class="ratings-val" style="width: {{$item->visit_count}}%;"></div>
                <!-- End .ratings-val -->
            </div><!-- End .ratings -->
            <span class="ratings-text">( {{$item->visit_count}} بازدید )</span>
        </div><!-- End .rating-container -->

        {{-- <div class="product-nav product-nav-thumbs">
            <a href="#" class="active">
                <img src="assets/images/products/product-4-thumb.jpg"
                    alt="product desc">
            </a>
            <a href="#">
                <img src="assets/images/products/product-4-2-thumb.jpg"
                    alt="product desc">
            </a>

            <a href="#">
                <img src="assets/images/products/product-4-3-thumb.jpg"
                    alt="product desc">
            </a>
        </div><!-- End .product-nav --> --}}
    </div><!-- End .product-body -->
</div><!-- End .product -->
