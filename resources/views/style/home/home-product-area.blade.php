@php
  $leftRight = lang() == 'en' ? 'left:0' : 'right:0';
@endphp
<!-- start product Area -->
<section class="section_gap home-products-section">
  @if ($products->isNotEmpty())
    <!-- single product slide -->
    <div class="single-product-slider">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <div class="section-title">
              <h1 class="text-white">{{trans('product.latest-products')}}</h1>
              <p class="text-white">{{trans('product.latest-products-desc')}}</p>
            </div>
          </div>
        </div>
        <div class="row">
        @foreach($products as $product)
          @php
            if (auth()->check()) {
                $wishListClass = (session()->has('wishlist') && isset(session('wishlist')->items[$product->id])) ? 'wishlist-added' : '';
            } else {
                $wishListClass = '';
            }
          @endphp
{{--          {{ dd($product->price_offer) }}--}}
            <!-- single product -->
            <div class="col-lg-3 col-md-4 col-6 mx-auto mb-4">
              <a href="{{ url('shop/view/' . $product->id) }}">
                <div class="product-home">
                  <img class="responsive" src="{{ Storage::url($product->photo) }}" alt="">
                  <div class="title">
                    <h6 title="{{$product->{'title_' . lang()} }}">{{ words($product->{'title_' . lang()}, '3') }}</h6>
                  </div>
                  <div class="price">
                    @if ($product->start_offer_at <= date("Y-m-d", time()))
                      @if (!is_null($product->price_offer))
                        <div class="offer">
                          <h6 class="l-through">{{ $product->price }}</h6>
                          <h6 class="offer-price">{{ $product->price_offer }}</h6>
                          <h6 class="offer-currency">{{ !is_null($product->country) ? $product->country->currency : '' }}</h6>
                        </div>
                      @else
{{--                        <h6 class="origin-price">{!! $product->price . '<br>' . $product->country->currency !!} </h6><br>--}}
                        <h6 class="text-white mb-0">{!! $product->price . $product->country->currency !!} </h6>
                      @endif
                    @else
{{--                      <h6 class="origin-price">{!! $product->price . '<br>' . $product->country->currency !!}</h6>--}}
                      <h6 class="text-white mb-0">{!! $product->price . $product->country->currency !!}</h6>
                    @endif
                  </div><!--.price-->
                  @if ($product->start_offer_at <= date("Y-m-d", time()))
                    @if (!is_null($product->price_offer))
                      <div class="offer-circle" style="{{ $leftRight }}">{{ trans('product.offer') }}</div>
                    @endif
                  @endif
                </div>
              </a>
            </div>
          @endforeach
        </div><!--.row-->
      </div><!--.container-->
    </div><!--.single-product-slider-->
  @endif
</section>
<!-- end product Area -->
@push('js')
  <script>
      items.fixImageHeight('.product-home');
      // items.fixImageHeight('.home-product');
  </script>
@endpush
