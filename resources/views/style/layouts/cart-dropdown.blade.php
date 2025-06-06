@php
    $dir = lang() == 'en' ? 'rtl' : 'ltr';
    $floatLeft = lang() == 'en' ? 'right' : 'left';
    $floatRight = lang() == 'en' ? 'left' : 'right';
@endphp
<ul class="minicart-product-list">
  @if (!empty(session('cart')))
    @foreach(session('cart')->items as $item)
      <li class="clearfix" style="direction: {{$dir}}">
        <div class="">
          <img src="{{Storage::url($item['photo'])}}" alt="item1" width="70" height="70" />
        </div>
        {{--			<div class="w-100 {{lang() == 'en' ? 'text-left' : 'text-right'}}">--}}
        <div class="w-100 text-left">
          <div class="item-name" title="{{ $item['item']->{'title_'.lang()} }}"><strong>{{substr($item['item']->{'title_'.lang()}, 0, 15)}}</strong></div>
          <div style="direction: {{lang() == 'ar' ? 'rtl' : 'ltr'}}" id="item_price_{{$item['item']->id}}" class="item-price pl-3">{{trans('product.price')}}: {{ $item['price'] }}</div>
          <div id="item_quantity_{{$item['item']->id}}" class="item-quantity pl-3">{{trans('product.quantity')}}: {{$item['qty']}}</div>
        </div>
      </li>
    @endforeach
  @else
    <li class="clearfix text-center">
      <h6 class="mb-0">{{trans('product.cart-empty')}}</h6>
    </li>
  @endif
</ul>
<p class="minicart-total">
  <span style="float: {{$floatRight}}">{{trans('product.total-price')}}:</span>
  <span class="cart-sub-price" style="float: {{$floatLeft}}">{{!empty(session('cart')) ? session('cart')->totalPrice : 0}}</span>
</p>
<div class="minicart-button" style="clear: both">
  <a href="{{ url('/cart') }}" class="li-button li-button-fullwidth">
    <span>{{trans('product.checkout')}}</span>
  </a>
  <a href="{{url('/empty-cart')}}" class="empty-cart-button li-button li-button-fullwidth bg-secondary">
    <span>{{trans('product.cart-empty-button')}}</span>
  </a>
</div>
