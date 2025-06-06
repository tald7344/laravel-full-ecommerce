@php
  $rtl = lang() == 'ar' ? 'rtl' : '';
  $links = [ ['url' => '#', 'name' => trans('admin.wishlist')] ];
@endphp
@extends('style.index')
@section('page-style', asset('design/style/css/custom/cart.css'))
@section('content')
  @include('style.layouts.header-image', [ 'imageUrl' => asset('images/bg-cart.png') ])
  @include('style.layouts.breadcrumbs', ['links' => $links, 'title' => trans('admin.wishlist-page')])
  <div class="shopping-cart-area pb-5 mt-5">
    <div class="container">
      @include('style.layouts.messages')
      @if (session()->has('wishlist'))
        <a href="{{url('empty-wishlist')}}" class="btn btn-dark mb-3" style="background: #092147; border-color: #092147">{{trans('product.wishlist-empty-button')}}</a>
      @endif
      <div class="row">
        <div class="col-12">
          <div class="add-to-cart-message text-center alert alert-success d-none mb-3"></div>
{{--          <form action="#">--}}
            <div class="table-content table-responsive" id="cart-container">
              <table class="table">
                <thead>
                <tr>
                  <th class="{{ $rtl }} li-product-remove"></th>
                  <th class="{{ $rtl }} li-product-thumbnail">{{trans('product.image')}}</th>
                  <th class="{{ $rtl }} cart-product-name">{{trans('admin.product_title')}}</th>
                  <th class="{{ $rtl }} li-product-price">{{trans('product.price')}}</th>
                  <th class="{{ $rtl }} li-product-price">{{trans('product.currency')}}</th>
                  <th class="{{ $rtl }} li-product-subtotal"></th>
                </tr>
                </thead>
                @if (Session::has('wishlist'))
                  <tbody>
                  @foreach($items as $key => $value)
                    <tr>
                      <td class="{{$rtl}} li-product-remove">
                        {!! Form::open(['route' => ['wishlist.destroy', $value['id']], 'method' => 'POST']) !!}
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
                      <td class="{{$rtl}} li-product-thumbnail">
                        <a href="{{ url('shop/view/' . $value['id']) }}">
                          @if(!is_null($value['photo']) && Storage::exists($value['photo']))
                            <img src="{{ Storage::url($value['photo']) }}" width="50" height="50">
                          @else
                            <img src="{{ asset('design/style/img/fav.png') }}" width="50" height="50"/>
                          @endif
                        </a>
                      </td>
                      <td class="{{$rtl}} li-product-name">
                        <a class="font-weight-bold d-block" href="{{ url('shop/view/' . $value['id']) }}">
                          {{ $value['item']->{'title_' . lang()} }}
                        </a>
                      </td>
                      <td class="{{$rtl}} li-product-price">
												<span class="amount">
                          {{ $value['price'] }}
												</span>
                      </td>
                      <td class="{{$rtl}} li-product-price">
												<span class="amount">
                          {{ $value['item']->country->currency }}
												</span>
                      </td>
                      <td class="{{$rtl}} product-subtotal">
                          <a class="add-cart"
                             data-id="{{$value['id']}}"
                             data-url="{{url('add-to-cart/'. $value['id'])}}"
                             style="white-space: nowrap"
                             href="javascript:void(0)">{{trans('product.add-to-cart')}}</a>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                @else
                  <tbody>
                    <tr>
                      <td colspan="6">
                        <h3 class="alert alert-info text-center mb-0">
                          {{ trans('product.wishlist-empty') }}
                        </h3>
                      </td>
                    </tr>
                  </tbody>
                @endif
              </table>
            </div>
{{--          </form>--}}
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
      // Add To Cart
      $('.add-cart').on('click', ajaxAddToCart);

      function ajaxAddToCart(e) {
        e.preventDefault();
        let ajaxUrl = $(this).data('url');
        let productId = $(this).data('id');
        $.ajax({
          url: ajaxUrl,
          method: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            id: productId
          },
          beforeSend: function () {
            $('.add-cart').css({'pointer-events' : 'none', 'filter': 'opacity(0.5)'});
          },
          error: function(xhr, status, error) {
            $('.add-cart').css({'pointer-events' : 'auto', 'filter': 'none'});
            console.log(xhr, status, error)
          },
          success: function(data, status, xhr) {
            if (status == 'success') {
              $('.add-cart').css({'pointer-events' : 'auto', 'filter': 'none'});
              // Add success message
              $('#custom-message').addClass('show');
              $('#custom-message .message-text').html(data.success);
              // display products in shopping cart box
              $('.minicart-product-list').html(JSON.parse(data.cartProducts));
              // display products Quantity
              $('.cart-badge').text(data.totalQty);
              // Display Products Total Prices
              $('.minicart .cart-sub-price').html(data.totalPrice);
            }
          },
        });
      }
    });
  </script>
@endpush
