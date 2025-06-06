<div class="common-filter">
  <div class="head">{{trans('product.price')}}</div>
  <div class="price-range-area pt-0">
    <div class="value-wrapper mt-0">
      <input type="range" class="w-100" id="lowerPrice" min="{{ $minPrice }}" max="{{ $maxPrice }}"
             value="{{ $minPrice }}" step="1" name="lowerPrice">
      <div class="">
        {{trans('product.lower-price-value')}} :
        <span class="lowerPriceValue">{{ $minPrice }}</span>
      </div>
    </div>
    <div class="value-wrapper">
      <input type="range" class="w-100" id="upperPrice" min="{{ $minPrice }}" max="{{ $maxPrice }}"
             value="{{ $maxPrice }}" step="1" name="upperPrice">
      <div class="">
        {{trans('product.upper-price-value')}} :
        <span class="upperPriceValue">{{ $maxPrice }}</span>
      </div>
    </div>
  </div>
</div>
