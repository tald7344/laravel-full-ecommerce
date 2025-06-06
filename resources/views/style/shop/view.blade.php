@php
  $right = lang() == 'ar' ? 'right' : 'left';
  $rtl = lang() == 'ar' ? 'rtl' : '';
  $links = [ ['url' => url('shop/desc'), 'name' => trans('admin.shop')], ['url' => '#', 'name' => trans('admin.product-details')] ];
  if (auth()->check()) {
      $wishListClass = (session()->has('wishlist') && isset(session('wishlist')->items[$product->id])) ? 'wishlist-added' : '';
  } else {
      $wishListClass = '';
  }
@endphp
@extends('style.index')
@section('page-style', asset('design/style/css/custom/product.css'))
@section('content')
{{--@include('style.layouts.header-image', [ 'imageUrl' => asset('images/bg-cart.jpg') ])--}}
@include('style.layouts.header-image', [ 'imageUrl' => asset('images/banner-shop.jpg') ])
@include('style.layouts.breadcrumbs', ['links' => $links, 'title' => trans('admin.product-details-page')])
<!--================Single Product Area =================-->
<div class="product_image_area">
  <div class="container">
    <div class="row s_product_inner">
      <div class="col-md-6 col-lg-6">
        <div class="product-details-image">
          <span id="zoom_button" class="zoom-button" style="{{$right}}: 0"><i class="fa fa-search fa-fw"></i></span>
          @if ($product->files->isEmpty())
              <img class="responsive" src="{{ Storage::url($product->photo) }}" alt="">
          @else
            <div class="s_Product_carousel h-100">
              <div class="single-prd-item zoom-hover">
                <img class="responsive zoom-image" src="{{ Storage::url($product->photo) }}" alt="">
              </div>
                @foreach($product->files as $file)
                  @if ($file->mime_type == 'image/jpeg')
                    <div class="single-prd-item zoom-hover">
                      <img class="responsive zoom-image" src="{{Storage::url($file->full_file)}}" alt="">
                    </div>
                  @endif
                @endforeach
            </div>
          @endif
        </div>
      </div>
      <div class="col-md-6 col-lg-5 offset-lg-1">
        <div class="s_product_text">
          <h3>{{ $product->{'title_' . lang()} }}</h3>
          <div class="price">
            @if ($product->start_offer_at <= date("Y-m-d", time()))
              @if (!is_null($product->price_offer))
                <span class="price-offer">{{trans('product.offer-price') . ' : ' . trans('product.from')}} <b>{{$product->start_offer_at}}</b> {{trans('product.to')}} <b>{{$product->end_offer_at}}</b></span><br>
                <h4 class="d-inline-block text-secondary" style="text-decoration: line-through;">{{ $product->price }}</h4>
                <h2 class="d-inline-block">{{ $product->price_offer . ' ' . $product->country->currency }}</h2>
              @else
                <h2 class="d-inline-block">{{ $product->price . ' ' . $product->country->currency }}</h2>
              @endif
            @else
              <h2 class="d-inline-block">{{ $product->price . ' ' . $product->country->currency }}</h2>
            @endif
          </div><!--.price-->
          <ul class="list">
            <li><span>{{trans('product.status')}}</span> : <span>{{ trans('product.'.$product->status) }}</span></li>
            <li><span>{{trans('admin.department')}}</span> : <span>{{ ucfirst($product->department->{'dep_name_' . lang()}) }}</span></li>
            @if (!is_null($product->stock))
              <li><span>{{trans('admin.stock')}}</span> : <span>{{$product->stock . ' ' . trans('product.pieces')}}</span></li>
            @endif
          </ul>
          <hr />
          <div class="product_count">
            <label for="qty">{{trans('product.quantity')}}:</label>
            <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                    class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                    class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
          </div>
          <div class="card_area d-flex align-items-center">
            <a class="primary-btn add-cart-single" href="javascript:void(0)"
               data-id="{{$product->id}}" data-url="{{url('add-to-cart/'. $product->id)}}"><span>{{trans('product.add-to-cart')}}</span></a>
{{--            <a class="" href="#"><i class="lnr lnr lnr-heart"></i></a>--}}
            <a class="add-wishlist icon_btn {{$wishListClass}}"
               id="add_wishlist_{{$product->id}}"
               data-id="{{$product->id}}"
               data-url="{{url('/add-to-wishlist/'. $product->id)}}"
               href="javascript:void(0)">
{{--              <span class="lnr lnr-heart"></span>--}}
              <i class="fa fa-heart"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
  <div class="container">
    <div class="product-tab-area box-drop-shadow">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{trans('admin.description')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
             aria-selected="false">{{trans('product.specification')}}</a>
        </li>
        {{--      <li class="nav-item">--}}
        {{--        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"--}}
        {{--           aria-selected="false">{{trans('product.comments')}}</a>--}}
        {{--      </li>--}}
        <li class="nav-item">
          <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
             aria-selected="false">{{trans('product.reviews')}}</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
          <p class="description">{{ $product->{'content_' . lang()} }}</p>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="table-responsive">
            <table class="table">
              <tbody>
              @if (!is_null($product->color))
                <tr>
                  <td>
                    <h5>{{trans('admin.color')}}</h5>
                  </td>
                  <td>
                    <h5>{{ $product->color->{'colors_name_' . lang()} }}</h5>
                  </td>
                </tr>
              @endif
              @if (!is_null($product->sizeName) && !empty($product->size))
                <tr>
                  <td>
                    <h5>{{trans('admin.size')}}</h5>
                  </td>
                  <td>
                    <h5>{{ $product->size . ' ' . $product->sizeName->{'sizes_name_' . lang()} }}</h5>
                  </td>
                </tr>
              @endif
              @if (!is_null($product->weight) && !is_null($product->weightName))
                <tr>
                  <td>
                    <h5>{{trans('admin.weight')}}</h5>
                  </td>
                  <td>
                    <h5>{{ $product->weight . ' ' . $product->weightName->{'weights_name_' . lang()} }}</h5>
                  </td>
                </tr>
              @endif
              @if (!is_null($product->trade))
                <tr>
                  <td>
                    <h5>{{trans('admin.trademarks')}}</h5>
                  </td>
                  <td>
                    <h5>{{ $product->trade->{'trademarks_name_' . lang()} }}</h5>
                  </td>
                </tr>
              @endif
              @if (!is_null($product->manufactory))
                <tr>
                  <td>
                    <h5>{{trans('admin.manufactory_name')}}</h5>
                  </td>
                  <td>
                    <h5>{{ $product->manufactory->{'manufactories_name_' . lang()} }}</h5>
                  </td>
                </tr>
              @endif
              @if ($product->malls->isNotEmpty())
                @foreach($product->malls as $mall)
                  <tr>
                    <td>
                      <h5>{{trans('admin.malls')}}</h5>
                    </td>
                    <td>
                      <h5>{{$mall->{'malls_name_' . lang()} }}</h5>
                    </td>
                  </tr>
                @endforeach
              @endif
              @if ($product->otherData->isNotEmpty())
                @foreach($product->otherData as $data)
                  <tr>
                    <td>
                      <h5>{{$data->{'data_key_'.lang()} }}</h5>
                    </td>
                    <td>
                      <h5>{{$data->data_value }}</h5>
                    </td>
                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
          </div>
        </div>
{{--        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">--}}
{{--          @include('style.shop.comments')--}}
{{--        </div>--}}
        <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
          @include('style.shop.reviews')
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Product Description Area =================-->

<!--================ Related Product Area =================-->
@if ($product->relatedProducts->isNotEmpty())
  <section class="related-products pb-5">
    <div class="container">
      <div class="box-drop-shadow">
        <div class="gradient-head p-3">
          <h4 class="mb-0 {{$rtl}}">{{trans('admin.related_product')}}</h4>
        </div>
        <div class="row py-4 py-md-5 px-3 {{ count($product->relatedProducts) > 2 ? 'related-product-slider' : '' }}">
{{--        <div class="row py-4 py-md-5 px-3 related-product-slider">--}}
          @foreach($product->relatedProducts as $related)
            @php
              if (auth()->check()) {
                  $wishListClass = (session()->has('wishlist') && isset(session('wishlist')->items[$product->id])) ? 'wishlist-added' : '';
              } else {
                  $wishListClass = '';
              }
            @endphp
            <div class="col-6 col-md-4 col-lg-3">
              @include('style.shop.product-template', ['product' => $related->product])
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endif
<!--================ Related Product Area =================-->

@endsection
@push('js')
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script>
    items.fixImageHeight('.product-home');
    items.addCart();                  // Add Product To Cart
    items.addWishlist();              // Add Product To Wishlist

    // height equal to width for product main image
    let containerImage = document.querySelector('.product-details-image');
    containerImage.style.height = containerImage.clientWidth + 'px';

    // Query
    $(document).ready(function () {
      const lang = '{{ lang() }}';
      const relatedProductsCount = {{ count($product->relatedProducts) }};
      if (window.innerWidth >= 992 && relatedProductsCount > 4) activeRelatedProductCarousel();
      if (window.innerWidth >= 768 && window.innerWidth < 992 && relatedProductsCount > 3) activeRelatedProductCarousel();
      if (window.innerWidth < 768 && relatedProductsCount > 2) activeRelatedProductCarousel();

      // Add Product To Cart
      $('.add-cart-single').on('click', ajaxAddToCart);
      // Add Product To Wishlist

      // change main image on click
      $(document).on('click', '.sm-image', function() {
        let selectedImage = $(this).find('img').attr('src');
        $('.zoom-image').attr('src', selectedImage);
      });

      // Zoom Image
      $('#zoom_button').click(function () {
        $(this).toggleClass('active');
        var zoomHover = $('.zoom-hover');
        // $(this).toggleClass('zoom-hover');
        zoomHover.toggleClass('zoom_image');
        if (zoomHover.hasClass('zoom_image')) {
          $('.zoom_image').zoom({
            magnify: "1.5",
          });
          var findZoomImgElem = setInterval(() => {
            let zoomImg = $('.zoomImg');
            if (zoomImg.attr('class') === 'zoomImg') {
              // make the zoomed image with auth height
              zoomImg.css('height', 'auto');
              // hide origin image on hover
              zoomImg.hover(
                () => { $('.zoom-image').css('opacity', '0'); },
                () => { $('.zoom-image').css('opacity', '1'); }
              );
              // clear interval in element was found
              clearInterval(findZoomImgElem);
            }
          }, 100);
        } else {
          $('.zoomImg').remove();
        }
      });

      function activeRelatedProductCarousel() {
        $('.related-product-slider').slick({
          autoplay: true,
          dots: false,
          infinite: false,
          arrows: false,
          rtl: lang == 'en' ? false : true,
          speed: 500,
          slidesToShow: 4,
          slidesToScroll: 4,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: false,
                dots: false
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });
      }

      function ajaxAddToCart(e) {
        console.log('add from single page');
        e.preventDefault();
        let ajaxUrl = $(this).data('url');
        let productId = $(this).data('id');
        let qty = $('.qty').val();

        $.ajax({
          url: ajaxUrl,
          method: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            id: productId,
            qty
          },
          beforeSend: function () {
            $('.add-cart').css({'pointer-events' : 'none', 'filter': 'opacity(0.5)'});
          },
          error: function(response) {
            $('.add-cart').css({'pointer-events' : 'auto', 'filter': 'none'});
            console.log(response);
          },
          success: function(data, status) {
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
