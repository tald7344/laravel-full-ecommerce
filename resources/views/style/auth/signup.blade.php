@extends('style.index')
{{--@section('page-style', asset('design/style/css/custom/login.css'))--}}
@section('content')
  @include('style.layouts.header-image', [
      'imageUrl' => asset('images/login-register.jpg'),
      'title' => trans('admin.login-register'),
      'links' => [
          ['url' => url('/'), 'name' => trans('admin.home'), 'arrow' => '<span class="lnr lnr-arrow-right"></span>'],
          ['url' => '#', 'name' => trans('admin.login-register'), 'arrow' => '']]])

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
            <a class="primary-btn" href="{{url('login')}}">{{ trans('auth.you-have-account') }}</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="login_form_inner pt-5">
          <h3>{{ trans('auth.signup-to-enter') }}</h3>
          <div class="col-10 mx-auto">
            @include('style.layouts.messages')
          </div>
          {!! Form::open(['route' => 'user.doSignup', 'method' => 'POST', 'id' => 'signupForm', 'class' => 'row login_form', 'novalidate' => 'novalidate']) !!}
            <div class="col-md-12 form-group">
              {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('auth.name'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.name') . '"' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('auth.email'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.email') . '"' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::text('password', old('password'), ['class' => 'form-control', 'placeholder' => trans('auth.password'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.password') . '"' ]) }}
            </div>
            <div class="col-md-12 form-group d-none">
              {{ Form::select('level', [
                      'user' => trans('admin.user_level'),
                      'company' => trans('admin.company_level'),
                      'vendor' => trans('admin.vendor_level'),
                  ], 'user' ,['class' => 'form-control', 'placeholder' => trans('auth.select-level')] )}}
            </div>
            <div class="col-md-12 form-group">
{{--              {{ Form::submit(trans('auth.signup'), ['class' => 'btn btn-primary primary-btn'] )}}--}}
              <button type="submit" value="submit" class="btn btn-primary primary-btn">{{trans('auth.signup')}}</button>
              <a href="{{url('login')}}" class="d-block d-md-none mt-1">{{ trans('auth.you-have-account') }}</a>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Login Box Area =================-->
@endsection
