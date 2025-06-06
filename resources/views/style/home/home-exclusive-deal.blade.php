@if ($hotProducts->isNotEmpty())
  <!-- Start exclusive deal Area -->
  <div class="{{ $hotProducts->count() > 1 ? 'active-exclusive-product-slider' : 'active-exclusive-product-single' }}" style="direction: {{ $ltr }}">
    @foreach($hotProducts as $product)
      @php
        $time = calc_date($product->start_offer_at, $product->end_offer_at);
        if ($time['isExpire']) {
            endProductHotOffer($product->id);
        }
      @endphp
      <section class="exclusive-deal-area single-exclusive-slider" style="direction: {{ $ltr }}">
        <div class="container-fluid">
          <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 no-padding exclusive-left">
              <div class="dead_line d-none">{{ $product->end_offer_at }}</div>
              <div class="row clock_sec clockdiv" id="clockdiv_{{$product->id}}">
                <div class="col-lg-12 mb-4">
                  <h1>{{ trans('product.exclusive-hot-deal') }}</h1>
                </div>
                <div class="col-lg-12">
                  <div class="row clock-wrap">
                    <div class="col clockinner1 clockinner">
                      <h1 class="days">{{$time['days']}}</h1>
                      <span class="smalltext">{{ trans('product.days') }}</span>
                    </div>
                    <div class="col clockinner clockinner1">
                      <h1 class="hours">{{ $time['hours'] }}</h1>
                      <span class="smalltext">{{ trans('product.hours') }}</span>
                    </div>
                    <div class="col clockinner clockinner1">
                      <h1 class="minutes">{{ $time['minutes'] }}</h1>
                      <span class="smalltext">{{ trans('product.mins') }}</span>
                    </div>
                    <div class="col clockinner clockinner1">
                      <h1 class="seconds">{{ $time['seconds'] }}</h1>
                      <span class="smalltext">{{ trans('product.secs') }}</span>
                    </div>
                  </div>
                </div>
              </div>
              <a href="{{ url('shop/view/' . $product->id) }}" class="primary-btn">{{ trans('product.view') }}</a>
            </div>
            <div class="col-lg-6 no-padding exclusive-right">
              <div class="exclusive-right-product-info p-0">
                <div class="">
                  <img style="max-height: 600px;" class="img-fluid" src="{{Storage::url($product->photo)}}" alt="">
                  <div class="product-details pt-4">
                    <div class="price">
                      @if (!is_null($product->price_offer))
                        <h6>{{ $product->price_offer }}</h6>
                        <h6 class="l-through">{{ $product->price }}</h6>
                      @else
                        <h6>{{ $product->price }}</h6>
                      @endif
                      <h6>{{ $product->country->currency }}</h6>
                    </div>
                    <h4>{{ words($product->{'title_' . lang()}, 5) }}</h4>
                    <div class="add-bag d-flex align-items-center justify-content-center">
                      <a class="add-btn add-cart d-flex align-items-center justify-content-center" href="javascript:void(0)"
                         data-id="{{$product->id}}" data-url="{{url('add-to-cart/'. $product->id)}}">
{{--                        <span class="ti-bag"></span>--}}
                        <i class="fa fa-shopping-bag text-white" style="font-size: .8em"></i>
                      </a>
                      <span class="add-text text-uppercase {{ lang() == 'ar' ? 'rtl' : '' }}">{{ trans('product.add-to-cart') }}</span>
                    </div>
                  </div>
                </div>
              </div><!--.exclusive-right-product-info-->
            </div><!--.exclusive-right-->
          </div><!--.row-->
        </div><!--.container-fluid-->
      </section>
    @endforeach
  </div>
  <!-- End exclusive deal Area -->
@endif
@push('js')
  <script>
      items.addCart();
  </script>
@endpush
