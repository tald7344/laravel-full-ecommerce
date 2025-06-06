@php
  $links = [ ['url' => '#', 'name' => trans('admin.profile')] ];
@endphp
@extends('style.index')
@section('page-style', asset('design/style/css/custom/profile.css'))
@section('content')
  @include('style.layouts.header-image', [ 'imageUrl' => asset('images/bg-profile.jpg') ])
  @include('style.layouts.breadcrumbs', ['links' => $links, 'title' => trans('admin.profile-page')])

  <section class="account-container mt-5">
    <div class="account-header">
      <div class="card-body">
        <ul class="account-nav nav nav-tabs">

          <li class="account-link active">
            <a data-id="#info">
              <i class="fa fa-user"></i>
              <span>
							{{ trans('auth.accountInfo') }}
						</span>
            </a>
          </li>
          <li class="account-link">
            <a data-id="#order">
              <i class="fa fa-shopping-cart"></i>
              <span>
							{{ trans('auth.my-orders') }}
						</span>
            </a>
          </li>
          <li class="account-link">
            <a data-id="#change_password">
              <i class="fa fa-file-text" aria-hidden="true"></i>
              <span>
							{{ trans('auth.change-password') }}
						</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-12 col-md-10 col-lg-9 col-xl-10 mx-auto" id="account-father">
      {{--		<div class="container p-0" id="account-content">--}}
      <div class="tab-content">
        <div id="info" class="tab-pane fade in active">
          @include('style.user.info', compact('user'))
        </div>
        <div id="order" class="tab-pane fade">
          @include('style.user.user-orders', compact('carts'))
        </div>
        <div id="change_password" class="tab-pane fade">
          @include('style.user.change-password')
        </div>
      </div>
      {{--		</div>--}}
    </div>
  </section>
@endsection

@push('js')
  <script type="text/javascript">
    $(document).ready(function() {
      $('.nav-tabs li').click(function () {
        console.log('click');
        $(this).addClass('active').siblings().removeClass('active');
        var Id = $(this).find('a').data('id');
        $(`${Id}`).addClass('active').siblings().removeClass('active');
      });
    });
  </script>
@endpush

