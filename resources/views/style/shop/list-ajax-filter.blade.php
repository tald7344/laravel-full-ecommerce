
@if ($products->isNotEmpty())
  @foreach($products as $product)
    @php
      if (auth()->check()) {
          $wishListClass = (session()->has('wishlist') && isset(session('wishlist')->items[$product->id])) ? 'wishlist-added' : '';
      } else {
          $wishListClass = '';
      }
    @endphp
    <div class="col-6 col-lg-4 col-xl-3 mb-4">
      @include('style.shop.product-template')
    </div>
  @endforeach
@else
  <div class="col-12 col-md-10 col-lg-8 mx-auto my-5">
    <div class="alert alert-warning text-center">{{ trans('product.empty-products') }}</div>
  </div>
@endif

