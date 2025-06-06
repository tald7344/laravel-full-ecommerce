@php
  $pl_1 = lang() == 'ar' ? 'ml-1' : 'mr-1';
  $rtl = lang() == 'ar' ? 'rtl' : '';
  $links = [ ['url' => '#', 'name' => trans('admin.cart')] ];
@endphp
@extends('style.index')
@section('page-style', asset('design/style/css/custom/cart.css'))
@section('content')
  @include('style.layouts.header-image', ['imageUrl' => asset('images/bg-cart.png')])
  @include('style.layouts.breadcrumbs', ['links' => $links, 'title' => trans('admin.cart-page')])

  <div class="shopping-cart-area pb-5">
    <div class="container mt-5">
      <div class="alert alert-danger text-center d-none response-error-msg"></div>
      <div class="alert alert-success text-center d-none response-success-msg"></div>
      @include('style.layouts.messages')
      @if (session()->has('cart'))
        <a href="{{url('empty-cart')}}" class="btn btn-dark mb-3" style="background: #092147; border-color: #092147">{{trans('product.cart-empty-button')}}</a>
      @endif
      <div class="row">
        <div class="col-12">
            <div class="table-content table-responsive" id="cart-container">
              <table class="table">
                <thead>
                <tr>
                  <th class="{{ $rtl }} li-product-remove"></th>
                  <th class="{{ $rtl }} li-product-thumbnail">{{trans('product.image')}}</th>
                  <th class="{{ $rtl }} cart-product-name">{{trans('admin.product_title')}}</th>
                  <th class="{{ $rtl }} li-product-price">{{trans('product.price')}}</th>
                  <th class="{{ $rtl }} li-product-price">{{trans('product.currency')}}</th>
                  <th class="{{ $rtl }} li-product-quantity">{{trans('product.quantity')}}</th>
                  <th class="{{ $rtl }} li-product-subtotal">{{trans('product.total')}}</th>
                </tr>
                </thead>
                @if (Session::has('cart'))
                  <tbody>
                  @foreach($items as $key => $value)
                    <tr>
                      <td class="{{ $rtl }} li-product-remove">
                        {!! Form::open(['route' => ['cart.destroy', $value['id']], 'method' => 'POST', 'class' => 'text-center']) !!}
                          {{ Form::hidden('_method', 'DELETE') }}
                          {{ Form::button(
                              '<i class="fa fa-times"></i>', [
                                  'type' => 'submit',
                                  'style' => 'padding: 5px 10px;cursor:pointer',
                                  'class' => 'border-0 bg-white'
                              ])
                          }}
                        {!! Form::close() !!}
                      </td>
                      <td class="{{ $rtl }} li-product-thumbnail">
                        <a href="{{ url('shop/view/' . $value['id']) }}">
                          @if(!is_null($value['photo']) && Storage::exists($value['photo']))
                            <img src="{{ Storage::url($value['photo']) }}" width="50" height="50">
                          @else
                            <img src="{{ asset('design/style/img/fav.png') }}" width="50" height="50"/>
                          @endif
                        </a>
                      </td>
                      <td class="{{ $rtl }} li-product-name">
                        <a class="font-weight-bold d-block" href="{{ url('shop/view/' . $value['id']) }}">
                          {{ $value['item']->{'title_'.lang()} }}
                        </a>
                      </td>
                      <td class="{{ $rtl }} li-product-price">
												<span class="amount">
													{{ $value['price'] }}
												</span>
                      </td>
                      <td class="{{ $rtl }} li-product-price">
												<span class="amount">
													{{ $value['item']->country->currency }}
												</span>
                      </td>
                      <td class="{{ $rtl }} quantity">
                        <div class="cart-plus-minus" data-url="{{url('update-cart/' . $value['id'])}}">
                          <input class="cart-plus-minus-box" value="{{ $value['qty'] }}" type="text" id="qty-{{ $value['id'] }}">
                          <div id="dec_{{$value['id']}}" class="dec qtybutton" data-id="{{ $value['id'] }}"><i class="fa fa-angle-down" data-id="{{ $value['id'] }}"></i></div>
                          <div id="inc_{{$value['id']}}" class="inc qtybutton" data-id="{{ $value['id'] }}"><i class="fa fa-angle-up" data-id="{{ $value['id'] }}"></i></div>
                        </div>
                      </td>
                      <td class="{{ $rtl }} product-subtotal">
												<span class="amount" id="item-price-{{ $value['id'] }}">
													{{  ($value['price'] * $value['qty']) }}
												</span>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                @else
                  <div class="flex flex-column mt-3 mb-2">
                    <h3 class="pt-2 alert alert-info text-center">
                      {{ trans('product.cart-empty') }}
                    </h3>
                  </div>
                @endif
              </table>
            </div>
            @if(Auth::check())
              <div class="row d-none">
                <div class="col-12">
                  <div class="coupon-all">
                    <div class="coupon">
                      <div class="mx-auto">
                        <input id="coupon_code" class="input-text" name="coupon_code" id="coupon_code" value="" placeholder="{{ trans('product.coupon-code') }}" type="text">
                        <input class="button" name="apply_coupon" id="apply_coupon" value="{{ trans('product.apply-coupon') }}" type="submit">
                      </div>
                      <div class="coupon2"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5 mx-auto">
                  <div class="cart-page-total">
                    <h2 class="text-center {{$rtl}}">{{ trans('product.total') }}</h2>
                    <ul>
                      {{-- <li>{{ trans('product.subtotal') }} <span class="cart-sub-price">{{ '$itemsSum' }}</span></li> --}}
                      <li>{{ trans('product.total') }} <span  class="cart-total-price {{$rtl}}">{{ session()->has('cart') ? session('cart')->totalPrice : 0 }}</span></li>
                    </ul>
                    <a href="{{ url('checkout') }}" class="w-100 text-center order-now">
                      {{ trans('product.order-now') }}
                    </a>
                  </div>
                </div>
              </div>
            @else
              <div class="row">
                <div class="col-12 mt-5 mb-4">
                  <h5 class="pt-2 alert alert-info text-center mb-0">
                    {{ trans('auth.cart-login') }}
                  </h5>
                </div>
                <div class="col-md-12 text-center ml-auto">
                  <div class="cart-page-total pt-0">
                    <a href="{{url('login')}}" class="mt-2">
                      {{ trans('auth.login') }}
                    </a>
                  </div>
                </div>
              </div>
            @endif
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
      var id = 0;

      $('#cart-container .inc.qtybutton').on('click',function() {
        // Get Product Id
        id = $(this).attr('data-id');
        // Get Quantity Input
        let qtyInput = $(this).siblings('.cart-plus-minus-box');
        // Get Quantity Number
        let qty = qtyInput.val();

        // Get Ajax URl
        let ajaxUrl = $(this).parents('.cart-plus-minus').data('url');
        // Increase number
        qty = Number(qty) + 1;
        // Ajax Update
        updateItemAjax(id, qtyInput, qty, ajaxUrl);
      });

      $('#cart-container .dec.qtybutton').on('click',function(){
        // Get Product Id
        id = $(this).attr('data-id');
        // Get Quantity Input
        let qtyInput = $(this).siblings('.cart-plus-minus-box');
        // Get Quantity Number
        let qty = qtyInput.val();
        // Get Ajax URl
        let ajaxUrl = $(this).parents('.cart-plus-minus').data('url');
        // Increase number
        qty = Number(qty) - 1;
        // Ajax Update
        updateItemAjax(id, qtyInput, qty, ajaxUrl);
      });

      function updateItemAjax(id, item, qty, ajaxUrl) {
        if (id == '' || qty == '') return;
        $.ajax({
          url: ajaxUrl,
          method: 'PUT',
          data: {
            _token: '{{ csrf_token() }}',
            id: id,
            qty: qty
          },
          beforeSend: function () {
            // disabled qty Button
            $('.qtybutton').css('pointer-events', 'none');
          },
          error: function(data, status, error) {
            $('.qtybutton').css('pointer-events', 'auto');
            $('.response-error-msg').removeClass('d-none').text(data.responseJSON.errors.qty[0]);
            // console.log(data, status, error);
            setTimeout(() => {
              $('.response-error-msg').addClass('d-none').fadeOut(1000);
            }, 3000);
            console.log(data.responseJSON.errors.qty[0]);
          },
          success: function(data, status) {
            if (status == 'success') {
              console.log(id, data.totalPrice, $('#item-price-' + id).text(), '#item_quantity_' + id, '#item_price_' + id);
              // Active qty Button
              $('.qtybutton').css('pointer-events', 'auto');
              // Display Products Total Prices In Cart Dropdown Box
              $('#item_quantity_' + id).text("{{trans('product.quantity')}}" + ': ' + data.qty);
              {{--$('#item_price_' + id).text("{{trans('product.price')}}" + ': ' + data.currency + ' ' + (data.price * data.qty));--}}
              $('#item_price_' + id).text("{{trans('product.price')}}" + ': ' + (data.price * data.qty));
              // $('.minicart-product-list').html(data.cartProducts);
              // display products Quantity
              $('.cart-badge').html(data.totalQty);
              // $('#cartCount').html(data.totalQty);
              // Change Quantity number In Quantity input
              $('.cart-total-price').html(data.totalPrice);
              // Display Products Total Prices
              $('.minicart .cart-sub-price').html(data.totalPrice);
              item.val(data.qty);
              // $('#item-price-' + id).text(data.currency + ' ' + (data.price * data.qty));
              $('#item-price-' + id).text((data.price * data.qty));
            }
          },
        });
      }
    });
  </script>
@endpush
