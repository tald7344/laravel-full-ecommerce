@php
  $mlr = lang() == 'en' ? 'ml-2 ml-sm-3 ml-md-4 ml-xl-5' : 'mr-2 mr-sm-3 mr-md-4 mr-xl-5';
  $mlrZero = lang() == 'en' ? 'ml-0' : 'mr-0';
  //$topUserDropDown = lang() == 'en' ? 'top: 60px;' : 'top: 60px;';
  $loginLeftRight = lang() == 'en' ? 'top: unset;left: unset;right:0;' : 'top: 50px;left: 0;right:unset;';
  $mobileLoginLeftRight = lang() == 'en' ? 'top: unset;left: unset;right:10%;' : 'top: unset;left: 10%;right:unset;';
  $pages = \App\Model\Page::where('slug', '!=', 'about-us')->where('slug', '!=', 'contact-us')->get();
@endphp

<!-- Start Header Area -->
<header class="header_area sticky-header">
  <div class="top_menu bg-white py-2 py-md-3 d-lg-none">
    <div class="container px-0">
      <ul class="nav navbar-nav navbar-right mobile-navbar d-lg-none" style="flex-direction: unset;">
        <li class="nav-item nav-wishlist submenu dropdown" style="display: inline-block;">
          <a href="{{url('wishlist')}}" class="position-relative">
            @if (Auth::check())
              <span class="badge wishlist-badge">{{ session()->has('wishlist') ? session('wishlist')->totalQty : '0'}}</span>
            @endif
              @if (lang() == 'en')
                <span class="ti-heart"></span>
              @else
                <i class="fa fa-heart"></i>
              @endif
          </a>
        </li>
        <li class="nav-item nav-cart" style="display: inline-block;">
          <a href="#" class="position-relative">
            <span class="badge cart-badge">{{!empty(session('cart')) ? session('cart')->totalQty : 0}}</span>
            @if (lang() == 'en')
              <span class="ti-bag"></span>
            @else
              <i class="fa fa-shopping-bag"></i>
            @endif
          </a>
          <ul class="minicart" style="{{$mobileLoginLeftRight}}">
            @include('style.layouts.cart-dropdown')
          </ul>
        </li>
        <li class="nav-item">
          <button class="search">
            @if (lang() == 'en')
              <span class="lnr lnr-magnifier" id="mobile_search"></span>
            @else
              <i class="fa fa-search" id="mobile_search"></i>
            @endif
          </button>
        </li>
        <li class="nav-item nav-login submenu dropdown" style="{{Auth::check() ? 'display: flex; align-items: center;' : 'display: inline-block;'}}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            @if (Auth::check())
              @if (!is_null(auth()->user()->image))
                <div class="user-login-circle"><img class="responsive" src="{{ Storage::url(auth()->user()->image) }}" alt="" style="object-fit: fill;"></div>
              @else
                <div class="user-login-circle">{{strtoupper(str_split(Auth::user()->name)[0])}}</div>
              @endif
            @else
              @if (lang() == 'en')
                <span class="ti-user"></span>
              @else
                <i class="fa fa-user"></i>
              @endif
            @endif
          </a>
          <ul class="dropdown-menu" style="{{$loginLeftRight}} {{ Auth::check() ? 'top: 60px;' : ''}}">
            @if (Auth::check())
              <li class="nav-item {{$mlrZero}} text-center"><a class="nav-link" href="{{route('user.profile')}}">{{trans('menu.profile')}}</a></li>
              <li class="nav-item {{$mlrZero}} text-center"><a class="nav-link" href="{{route('user.logout')}}">{{trans('menu.logout')}}</a></li>
            @else
              <li class="nav-item {{$mlrZero}} text-center"><a class="nav-link" href="{{url('/login')}}">{{trans('menu.login')}}</a></li>
              <li class="nav-item {{$mlrZero}} text-center"><a class="nav-link" href="{{url('/signup')}}">{{trans('menu.signup')}}</a></li>
            @endif
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light main_box">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand logo_h" href="{{url('/')}}"><img class="responsive" src="{{Storage::url(setting()->logo)}}" alt=""></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
          <ul class="nav navbar-nav menu_nav ml-auto">
            <li class="nav-item {{$mlr}} {{ activate_menu('home', 'user')[0] }}"><a class="nav-link" href="{{url('/')}}">{{trans('menu.home')}}</a></li>
            <li class="nav-item {{$mlr}} {{ activate_menu('shop', 'user')[0] }}"><a class="nav-link" href="{{url('shop/desc')}}">{{trans('menu.shop')}}</a></li>
{{--            <li class="nav-item {{$mlr}} submenu dropdown">--}}
{{--              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"--}}
{{--                 aria-expanded="false">Blog</a>--}}
{{--              <ul class="dropdown-menu">--}}
{{--                <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>--}}
{{--                <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>--}}
{{--              </ul>--}}
{{--            </li>--}}
            @if ($pages->isNotEmpty())
              <li class="nav-item {{$mlr}} submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">{{ trans('admin.pages') }}</a>
                <ul class="dropdown-menu">
                  @foreach($pages as $page)
                    <li class="nav-item"><a class="nav-link" href="{{ url('page/' . $page->slug) }}">{{ $page->{'name_' . lang()} }}</a></li>
                  @endforeach
                </ul>
              </li>
            @endif
            <li class="nav-item {{$mlr}} {{ activate_menu('page/about-us', 'user')[0] }}"><a class="nav-link" href="{{url('page/about-us')}}">{{trans('menu.about-us')}}</a></li>
            <li class="nav-item {{$mlr}} {{ activate_menu('contact', 'user')[0] }}"><a class="nav-link" href="{{url('contact')}}">{{trans('menu.contact')}}</a></li>
            @if (lang() == 'ar')
              <li class="nav-item {{$mlr}}"><a class="nav-link" href="{{ url('lang/en') }}">{{trans('menu.english')}}</a></li>
            @else
              <li class="nav-item {{$mlr}}"><a class="nav-link" href="{{ url('lang/ar') }}">{{trans('menu.arabic')}}</a></li>
            @endif
          </ul>
          <ul class="nav navbar-nav navbar-right d-none d-lg-flex align-items-center">
            <li class="nav-item nav-wishlist submenu dropdown" style="display: inline-block;">
              <a href="{{url('wishlist')}}" class="position-relative">
                @if (Auth::check())
                  <span class="badge wishlist-badge">{{ session()->has('wishlist') ? session('wishlist')->totalQty : '0'}}</span>
                @endif
                @if (lang() == 'en')
                  <span class="ti-heart"></span>
                @else
                  <i class="fa fa-heart"></i>
                @endif
              </a>
            </li>
            <li class="nav-item nav-cart submenu dropdown" style="display: inline-block;">
              <a href="#" class="dropdown-toggle position-relative" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="badge cart-badge">{{!empty(session('cart')) ? session('cart')->totalQty : 0}}</span>
                @if (lang() == 'en')
                  <span class="ti-bag"></span>
                @else
                  <i class="fa fa-shopping-bag"></i>
                @endif
              </a>
              <ul class="minicart dropdown-menu" style="{{$loginLeftRight}}">
                @include('style.layouts.cart-dropdown')
              </ul>
            </li>
            <li class="nav-item">
              <button class="search">
                @if (lang() == 'en')
                  <span class="lnr lnr-magnifier" id="search"></span>
                @else
                  <i class="fa fa-search" id="search"></i>
                @endif
              </button>
            </li>
            <li class="nav-item nav-login submenu dropdown" style="{{Auth::check() ? 'display: flex; align-items: center;' : 'display: inline-block;'}}">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                @if (Auth::check())
                  @if (!is_null(auth()->user()->image))
                    <div class="user-login-circle"><img class="responsive" src="{{ Storage::url(auth()->user()->image) }}" alt="" style="object-fit: fill;"></div>
                  @else
                    <div class="user-login-circle">{{strtoupper(str_split(Auth::user()->name)[0])}}</div>
                  @endif
                @else
                  @if (lang() == 'en')
                    <span class="ti-user"></span>
                  @else
                    <i class="fa fa-user fa-lg"></i>
                  @endif
                @endif
              </a>
              <ul class="dropdown-menu" style="{{$loginLeftRight}} {{Auth::check() ? 'top: 60px;' : ''}}">
                @if (Auth::check())
                  <li class="nav-item {{$mlrZero}} text-center"><a class="nav-link" href="{{route('user.profile')}}">{{trans('menu.profile')}}</a></li>
                  <li class="nav-item {{$mlrZero}} text-center"><a class="nav-link" href="{{route('user.logout')}}">{{trans('menu.logout')}}</a></li>
                @else
                  <li class="nav-item {{$mlrZero}} text-center"><a class="nav-link" href="{{url('/login')}}">{{trans('menu.login')}}</a></li>
                  <li class="nav-item {{$mlrZero}} text-center"><a class="nav-link" href="{{url('/signup')}}">{{trans('menu.signup')}}</a></li>
                @endif
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <div class="search_input d-none" id="search_input_box">
    <div class="container">
      <form class="d-flex justify-content-between align-items-center">
        <input type="text" class="form-control" id="search_input" placeholder="{{trans('menu.search-here')}}">
        <button type="submit" class="btn"></button>
        @if (lang() == 'en')
          <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
        @else
          <i class="fa fa-close" id="close_search" title="Close Search"></i>
        @endif
      </form>
    </div>
  </div>
</header>
<!-- End Header Area -->
<div class="result-section d-none">
  <div class="content"></div>
  @include('style.layouts.loader', ['slug' => 'search'])
</div>
@push('js')
  <script>
    $(document).ready(function () {
      $('.top_menu .nav-cart').on('click', function () {
        $(this).find('.minicart').css('display', 'block');
      });
      $(document).click(e => {
          let classes = ['', 'ti-bag', 'fa fa-shopping-bag', 'badge cart-badge', 'minicart-product-list', 'minicart', 'clearfix text-center', 'mb-0', 'cart-sub-price'];
          if (!classes.includes(e.target.classList.value)) {
            $('.top_menu .nav-cart .minicart').css('display', 'none');
          }
      });
      $('#search_input').keyup(debounce(function (e) {
        let value = e.target.value;
        if (value == '') return;
        $.ajax({
          url: '{{ route('product.search') }}',
          type: 'POST',
          data: {
            _token: '{{csrf_token()}}',
            value
          },
          beforeSend: function () {
            $('.result-section').removeClass('d-none');
            $('.result-section .content').addClass('d-none');
            $('.result-section .overflow-section').removeClass('d-none');
          },
          error: function (response) {
            console.log('error => ', response);
          },
          success: function (response, status) {
            if (status == 'success') {
              $('.result-section .content').removeClass('d-none').html(response.result);
              $('.result-section .overflow-section').addClass('d-none');
              items.fixImageHeight('.product-home');
              items.addCart();                  // Add Product To Cart
              items.addWishlist();              // Add Product To Wishlist
            }
          }
        });
      }));

      function debounce(cb, delay = 750) {
        let timeout
        return (...args) => {
          clearTimeout(timeout)
          timeout = setTimeout(() => {
            cb(...args)
          }, delay)
        }
      }

    });
  </script>
@endpush
