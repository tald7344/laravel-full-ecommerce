@if($brands->isNotEmpty())
  <div class="common-filter">
    <div class="head">{{trans('product.brands')}}</div>
    <ul>
      <li class="filter-list">
        <input class="pixel-radio" type="radio" id="brand_0" name="brand" value="0" checked>
        <label for="brand_0">
          {{ trans('product.all') }}
        </label>
      </li>
      @foreach($brands as $brand)
        <li class="filter-list">
          <input class="pixel-radio" type="radio" name="brand" id="brand_{{ $brand->id }}"
                 value="{{ $brand->id }}">
          <label for="brand_{{ $brand->id }}">
            {{ $brand->{'trademarks_name_' . lang()} }}
            <span> ( {{ $brand->active_products_count }} )</span>
          </label>
        </li>
      @endforeach
    </ul>
  </div>
@endif
