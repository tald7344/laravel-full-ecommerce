@if($colors->isNotEmpty())
  <div class="common-filter">
    <div class="head">{{trans('product.colors')}}</div>
    <ul>
      <li class="filter-list">
        <input class="pixel-radio" type="radio" id="color_0" name="color" value="0" checked>
        <label for="color_0">
          {{ trans('product.all') }}
        </label>
      </li>
      @foreach($colors as $color)
        <li class="filter-list">
          <input class="pixel-radio" type="radio" id="color_{{ $color->id }}" name="color"
                 value="{{ $color->id }}">
          <label for="color_{{ $color->id }}">
            {{ $color->{'colors_name_' . lang()} }}
            <span> ( {{ $color->active_products_count }} )</span>
          </label>
        </li>
      @endforeach
    </ul>
  </div>
@endif
