@php
  $rtl = lang() == 'ar' ? 'rtl' : '';
@endphp
@include('style.layouts.messages')
<div class="card checkout-area change-password {{$rtl}} py-3">
  <div class="col-11 col-md-9 col-lg-7 mx-auto">
    <div class="card-body">
      {!! Form::open(['route' => 'user.changePassword', 'method' => 'POST']) !!}
        {{ Form::hidden('_method', 'PUT') }}
        <div class="form-group">
          {{ Form::label('password', trans('auth.new-password')) }}
          {{ Form::password('password', ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
          {{ Form::label('password_confirmation', trans('auth.confirmation-password')) }}
          {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        </div>
        {{ Form::submit(trans('auth.update-password'), ['class' => 'btn btn-block'] )}}
      {!! Form::close() !!}
    </div>
  </div>
</div>
