<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ trans('admin.login') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('design/adminLte')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('design/adminLte')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('design/adminLte')}}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
{{--    <a href="{{asset('design/adminLte')}}/index2.html"><b>Admin</b>LTE</a>--}}
    <span>{{ trans('admin.dashboard-login') }}</span>
  </div>
  <!-- /.login-logo -->
  <div class="card">
      <div class="card-body login-card-body">
      @include('admin.layouts.message')
      <p class="login-box-msg">{{trans('admin.sign-in-start-session')}}</p>

      <form method="post">
          {!! csrf_field() !!}
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="{{ trans('admin.email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="{{ trans('admin.password') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="rememberme" id="remember">
              <label for="remember">
                {{ trans('admin.remember-me') }}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ trans('admin.sign-in') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="{{aurl('forgot/password')}}">{{ trans('admin.forgot-password') }}</a>
      </p>
{{--       <p class="mb-0">--}}
{{--        <a href="{{aurl('redirect/facebook')}}" class="text-center">Register With Facebook</a>--}}
{{--      </p>--}}
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('design/adminLte')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('design/adminLte')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('design/adminLte')}}/dist/js/adminlte.min.js"></script>

</body>
</html>
