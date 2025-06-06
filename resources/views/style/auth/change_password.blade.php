@extends('style.index')
{{--@section('page-style', asset('design/style/css/custom/login.css'))--}}
@section('content')
  @include('style.layouts.header-image', [
      'imageUrl' => asset('images/login-register.jpg'),
      'title' => trans('admin.change-password'),
      'links' => [
          ['url' => url('/'), 'name' => trans('admin.home'), 'arrow' => '<span class="lnr lnr-arrow-right"></span>'],
          ['url' => '#', 'name' => trans('auth.change-password'), 'arrow' => '']]])

  <!--================Login Box Area =================-->
  <section class="login_box_area section_gap">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mx-auto">
          <div class="login_form_inner">
            <h3>{{ trans('auth.change-password') }}</h3>
            <div class="col-10 mx-auto">
              @include('style.layouts.messages')
            </div>
            {!! Form::open(['method' => 'POST', 'class' => 'row login_form', 'novalidate' => 'novalidate']) !!}
            <div class="col-md-12 form-group">
              {{ Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('auth.email'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.email') . '"' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::text('password', old('password'), ['class' => 'form-control', 'placeholder' => trans('auth.password'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.password') . '"' ]) }}
            </div>
            <div class="col-md-12 form-group">
              {{ Form::text('password_confirmation', old('password_confirmation'), ['class' => 'form-control', 'placeholder' => trans('auth.confirmation-password'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.confirmation-password') . '"' ]) }}
            </div>
            <div class="col-md-12 form-group">
              <button type="submit" value="submit" class="primary-btn">{{trans('auth.change-password')}}</button>
              <p class="mb-1">
                <a href="{{url('login')}}">{{ trans('auth.login') }}</a>
              </p>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Login Box Area =================-->
@endsection
