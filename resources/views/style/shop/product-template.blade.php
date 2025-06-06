@php
  $leftRight = lang() == 'en' ? 'left:0' : 'right:0';
  $rtl = lang() == 'ar' ? 'rtl' : '';
  $currency = $product->country ? $product->country->currency : '';
@endphp
<a href="{{ url('shop/view/' . $product->id) }}" class="unset-hover">
  <div class="product-home">
    <img class="responsive" src="{{ Storage::url($product->photo) }}" alt="">
    <div class="title">
      <h6 class="{{$rtl}}" title="{{$product->{'title_' . lang()} }}">{{ words($product->{'title_' . lang()}, '3') }}</h6>
    </div>
    <div class="price">
      @if ($product->start_offer_at <= date("Y-m-d", time()))
        @if (!is_null($product->price_offer))
          <div class="offer">
            <h6 class="l-through">{{ $product->price }}</h6>
            <h6 class="offer-price">{{ $product->price_offer }}</h6>
            <h6 class="offer-currency">{{ $currency }}</h6>
          </div>
        @else
          <h6
{{--            class="origin-price">{!! $product->price . '<br>' . $currency !!} </h6>--}}
            class="text-white mb-0">{!! $product->price . $currency !!} </h6>
          <br>
        @endif
      @else
{{--        <h6 class="origin-price">{!! $product->price . '<br>' . $currency !!}</h6>--}}
        <h6 class="text-white mb-0">{!! $product->price . $currency !!}</h6>
      @endif
    </div><!--.price-->
    <div class="prd-bottom {{lang() == 'ar' ? 'rtl' : 'ltr'}}">
      <ul class="list-unstyled">
        <li>
          <p href="javascript:void(0)" class="social-info add-cart" id="order-btn"
             data-id="{{$product->id}}" title="{{ trans('product.add-to-cart') }}" data-url="{{url('add-to-cart/'. $product->id)}}">
            <i class="fa fa-shopping-bag fa-lg"></i>
{{--            <span class="ti-bag"></span>--}}
          </p>
        </li>
        <li>
          <p class="add-wishlist social-info {{$wishListClass}}"
             id="add_wishlist_{{$product->id}}"
             data-id="{{$product->id}}" title="{{ trans('product.add-to-wishlist') }}"
             data-url="{{url('/add-to-wishlist/'. $product->id)}}"
             href="javascript:void(0)">
            <i class="fa fa-heart fa-lg"></i>
            {{--                                <span class="lnr lnr-heart"></span>--}}
          </p>
        </li>
        <li>
          <p data-caption="{{$product->title }}"
             data-fancybox="images-{{ $product->id }}"
             href="{{ Storage::url($product->photo) }}"
             title="quick view" class="social-info text-center">
            <i class="fa fa-eye fa-lg"></i>
            {{--                                <span class="lnr lnr-eye"></span>--}}
          </p>
        </li>
      </ul>
    </div><!--.prd-bottom-->
    @if ($product->start_offer_at <= date("Y-m-d", time()))
      @if (!is_null($product->price_offer))
        <div class="offer-circle" style="{{ $leftRight }}">{{ trans('product.offer') }}</div>
      @endif
    @endif
  </div>
{{--  <div class="single-product d-none">--}}
{{--    <img class="img-fluid" src="{{ Storage::url($product->photo) }}" alt="">--}}
{{--    <div class="product-details d-none">--}}
{{--      <h6--}}
{{--        title="{{$product->{'title_' . lang()} }}">{{ words($product->{'title_' . lang()}, '2') }}</h6>--}}
{{--      <div class="price">--}}
{{--        @if ($product->start_offer_at <= date("Y-m-d", time()))--}}
{{--          @if (!is_null($product->price_offer))--}}
{{--            <h6>{{ $product->price_offer . ' ' . $product->country->currency }}</h6>--}}
{{--            <h6 class="l-through">{{ $product->price . ' ' . $product->country->currency }}</h6>--}}
{{--          @else--}}
{{--            <h6>{{ $product->price . ' ' . $product->country->currency }}</h6>--}}
{{--          @endif--}}
{{--        @else--}}
{{--          <h6>{{ $product->price . ' ' . $product->country->currency }}</h6>--}}
{{--        @endif--}}
{{--      </div>--}}
{{--      <div class="prd-bottom">--}}
{{--        <a href="javascript:void(0)" class="social-info add-cart" id="order-btn"--}}
{{--           data-id="{{$product->id}}" data-url="{{url('add-to-cart/'. $product->id)}}">--}}
{{--          <span class="ti-bag"></span>--}}
{{--        </a>--}}
{{--        <a class="add-wishlist social-info {{$wishListClass}}"--}}
{{--           id="add_wishlist_{{$product->id}}"--}}
{{--           data-id="{{$product->id}}"--}}
{{--           data-url="{{url('/add-to-wishlist/'. $product->id)}}"--}}
{{--           href="javascript:void(0)">--}}
{{--          <span class="lnr lnr-heart"></span>--}}
{{--        </a>--}}
{{--        --}}{{--                        <a href="" class="social-info">--}}
{{--        --}}{{--                          <span class="lnr lnr-eye"></span>--}}
{{--        --}}{{--                        </a>--}}
{{--        <a data-caption="{{$product->title }}"--}}
{{--           data-fancybox="images-{{ $product->id }}"--}}
{{--           href="{{ Storage::url($product->photo) }}"--}}
{{--           title="quick view" class="social-info text-center">--}}
{{--          <span class="lnr lnr-eye"></span>--}}
{{--        </a>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--    @if ($product->start_offer_at <= date("Y-m-d", time()))--}}
{{--      @if (!is_null($product->price_offer))--}}
{{--        <div class="offer-circle" style="{{ $leftRight }}">{{ trans('product.offer') }}</div>--}}
{{--      @endif--}}
{{--    @endif--}}
{{--  </div>--}}
</a>
