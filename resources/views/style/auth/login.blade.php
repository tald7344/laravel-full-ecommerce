@php
  $links = [ ['url' => '#', 'name' => trans('admin.login-register')] ];
@endphp
@extends('style.index')
@section('content')
@include('style.layouts.header-image', [ 'imageUrl' => asset('images/login-register.jpg') ])
<!--================Login Box Area =================-->
<section class="login_box_area section_gap">
  <div class="container">
    <div class="row">
      <div class="col-md-6 d-none d-md-block">
        <div class="login_box_img">
          <img class="img-fluid" src="{{asset('design/style/img/login.jpg')}}" alt="">
          <div class="hover">
            <h4>{{ trans('auth.new-to-website') }}</h4>
            <p>{{ trans('auth.there-is-always-material-to-find') }}</p>
            <a class="primary-btn" href="{{url('signup')}}">{{ trans('auth.create-account') }}</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="login_form_inner">
          <h3 class="mb-3">{{ trans('auth.login-to-enter') }}</h3>
          <div class="row w-100 mx-auto">
            <div class="col-9 mx-auto">
              <p class="btn btn-facebook-login w-100">
                <a href="{{url('redirect/facebook')}}" class="text-center">{{ trans('auth.facebook-login') }}</a>
              </p>
            </div>
          </div>
          <div class="col-10 mx-auto">
            @include('style.layouts.messages')
          </div>
          {!! Form::open(['route' => 'user.doLogin', 'method' => 'POST', 'id' => 'loginForm', 'class' => 'row login_form', 'novalidate' => 'novalidate']) !!}
            <div class="col-md-12 form-group">
              {{ Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('auth.email'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.email') . '"' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::text('password', old('password'), ['class' => 'form-control', 'placeholder' => trans('auth.password'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.password') . '"' ]) }}
            </div>
            <div class="col-md-12 form-group">
              <button type="submit" value="submit" class="primary-btn">{{trans('auth.login')}}</button>
              <a href="{{ url('forgot/password') }}">{{trans('auth.forgot-password')}}</a>
              <a href="{{url('signup')}}" class="d-block d-md-none mt-1">{{ trans('auth.create-account') }}</a>
            </div>
          {!! Form::close() !!}
{{--          </form>--}}
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Login Box Area =================-->
@endsection
