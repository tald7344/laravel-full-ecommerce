@if (count($productsId) > 0)
<!-- Start related-product Area -->
<section class="related-product-area section_gap_bottom">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 text-center">
        <div class="section-title">
          <h2>{{ trans('home.weak-deals') }}</h2>
{{--          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="row">
          @foreach($productsId as $id)
            @php
              $product = \App\Model\Product::find($id);
            @endphp
            @if (!is_null($product))
              <div class="col-lg-4 col-md-4 col-sm-6 mb-3 mx-auto">
                <div class="single-related-product d-flex align-items-center justify-content-center" style="gap: 5px;">
                  <a href="{{ url('shop/view/' . $product->id) }}"><img width="75" height="75" src="{{Storage::url($product->photo)}}" alt=""></a>
                  <div class="desc">
                    <a href="{{ url('shop/view/' . $product->id) }}" class="title">{{ words($product->{'title_' . lang()}, '3') }}</a>
                    <div class="price">
                      @if (!is_null($product->price_offer))
                        <h6>{{ $product->price_offer }}</h6>
                        <h6 class="l-through">{{ $product->price }}</h6>
                      @else
                        <h6>{{ $product->price }}</h6>
                      @endif
                      <h6>{{ $product->country->currency ?? '' }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div><!--.row-->
      </div><!--.col-12-->
    </div><!--.row-->
  </div>
</section>
<!-- End related-product Area -->
@endif
