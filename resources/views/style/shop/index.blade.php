@php
  $pl_5 = lang() == 'ar' ? 'pr-5' : 'pl-5';
  // $leftRight = lang() == 'ar' ? 'left:20px' : 'right:20px';
  $leftRight = lang() == 'en' ? 'left:0' : 'right:0';
  $links = [ ['url' => '#', 'name' => trans('admin.shop')] ];
@endphp

@extends('style.index')
@section('page-style', asset('design/style/css/custom/product.css'))
@section('content')
  @include('style.layouts.header-image', [ 'imageUrl' => asset('images/banner-shop.jpg') ])
  @include('style.layouts.breadcrumbs', ['links' => $links, 'title' => trans('admin.shop-page')])
  <section class="product-list pb-4 pb-lg-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-4 mb-3">
          @include('style.shop.filters.categories-filter')
          <div class="sidebar-filter box-drop-shadow mt-3 mt-md-4">
            <div class="top-filter-head">{{trans('product.products-filters')}}</div>
            <div class="sidebar-form">
              <form action="#" id="products_filter" method="post">
                {{ csrf_field() }}
                @include('style.shop.filters.brands-filter')
                @include('style.shop.filters.colors-filter')
                @include('style.shop.filters.prices-filter')
              </form>
            </div><!--.sidebar-form-->
          </div><!--.sidebar-filter-->
        </div>
        <div class="col-xl-9 col-lg-8 col-md-8">
          <!-- Start Filter Bar -->
          <div class="filter-bar d-flex flex-wrap align-items-center">
            <div class="sorting">
              <div class="btn-group btn-group-toggle" data-toggle="buttons" id="sort_product">
                <label class="btn btn-outline-dark {{$sort == 'desc' ? 'focus active' : ''}}">
                  <input type="radio" name="sorts" id="desc" autocomplete="off" {{$sort == 'desc' ? 'checked' : ''}}> {{ trans('product.newest') }}
                </label>
                <label class="btn btn-outline-dark {{$sort == 'asc' ? 'focus active' : ''}}">
                  <input type="radio" name="sorts" id="asc" autocomplete="off" {{$sort == 'asc' ? 'checked' : ''}}> {{ trans('product.oldest') }}
                </label>
              </div>
{{--              <select id="sort_product" name="sort">--}}
{{--                <option value="desc" {{$sort == 'desc' ? 'selected' : ''}}>{{ trans('product.newest') }}</option>--}}
{{--                <option value="asc" {{$sort == 'asc' ? 'selected' : ''}}>{{ trans('product.oldest') }}</option>--}}
{{--              </select>--}}
            </div>
            <div class="pagination ml-auto">
              {{$products->links()}}
            </div>
          </div>
          <!-- End Filter Bar -->
          <!-- Start Best Seller -->
          <section class="latest-product-area py-3 py-md-4 category-list position-relative">
            <div class="row w-100 mx-auto">
              <!-- single product -->
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
            <!-- single product -->
            </div>
            @include('style.layouts.loader', ['slug' => 'products'])
          </section>
          <!-- End Best Seller -->
        </div>
      </div><!--.row-->
    </div><!--.container-->
  </section>
  <!-- End related-product Area -->
@endsection

@push('js')
  <script>
    items.fixImageHeight('.product-home');
    // items.fixImageHeight('.single-product');
    items.addCart();                  // Add Product To Cart
    items.addWishlist();              // Add Product To Wishlist

    // ajax products filter
    $(document).ready(function () {
      if (window.innerWidth < 768) {
        $('.sidebar-form, .main-categories').hide();
        // minimize filter sidebar
        $('.top-filter-head').click((e) => minimizeFilterForm(e, '.sidebar-form'));
        $('.sidebar-categories .head').click((e) => minimizeFilterForm(e, '.main-categories'));
      }

      $('#lowerPrice').change(function (e) {
        $('.lowerPriceValue').text(e.target.value);
      });
      $('#upperPrice').change(function (e) {
        $('.upperPriceValue').text(e.target.value);
      });
      // Filter Using Ajax
      $('#products_filter').change(callAjax);
      // Sort Products Without ajax
      $('#sort_product').change(sortProducts);


      function callAjax() {
        const formData = new FormData(this);
        const categoryId = String(location.pathname).split('/').reverse()[0];
        if (Number.isInteger(parseInt(categoryId))) {
          formData.append('categoryId', categoryId);
        }
        $.ajax({
          url: '{{ url('ajax-filter-product') }}',
          type: 'post',
          dataType: 'html',
          contentType: false,
          processData: false,
          data: formData,
          beforeSend: function () {
            $('.overflow-section').removeClass('d-none');
          },
          error: function (response) {
            console.log('error : ', response);
            $('.overflow-section').addClass('d-none');
          },
          success: function (response) {
            if (response) {
              $('.overflow-section').addClass('d-none');
              $('.latest-product-area .row').html(response);
              items.fixImageHeight('.product-home');
            }
          }
        });
      }

      function sortProducts(d) {
        let oldSort = '{{ $sort }}';
        let url = '{{ request()->url() }}';
        let urlArray = url.split('/');
        let sortIndex = urlArray.findIndex(e => e == oldSort);
        if (sortIndex > -1 && d.target.id != oldSort) {
          urlArray.splice(sortIndex, 1, d.target.id);
          location.href = urlArray.join('/');
        }
      }

      function minimizeFilterForm(e, target) {
        e.stopImmediatePropagation();
        $(target).slideToggle();
      }

    });
  </script>
@endpush
