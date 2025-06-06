@php
  $rtl = lang() == 'ar' ? 'rtl' : '';
@endphp
@extends('style.index')
@section('page-style', asset('design/style/css/custom/profile.css'))
@section('content')
  @include('style.layouts.header-image', [
      'imageUrl' => asset('images/bg-profile.jpg'),
      'title' => trans('admin.profile-page'),
      'links' => [
          ['url' => url('/'), 'name' => trans('admin.home'), 'arrow' => '<span class="lnr lnr-arrow-right"></span>'],
          ['url' => '#', 'name' => trans('admin.profile'), 'arrow' => '']]])

<div class="edit-profile {{$rtl}} py-3">
  <h2 class="text-center">{{trans('auth.edit-account-info')}}</h2>
  <div class="col-11 col-md-10 mx-auto">
    <div class="card-body">
      @include('style.layouts.messages')
      {!! Form::open(['route' => 'user.editProfile', 'method' => 'POST', 'files' => true]) !!}
        {{ Form::hidden('_method', 'PUT') }}
        <div class="form-group">
          {{ Form::label('name', trans('auth.name')) }}
          {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
          {{ Form::label('email', trans('auth.email')) }}
          {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
          {{ Form::label('level', trans('auth.level')) }}
          {{ Form::text('level', $user->level, ['class' => 'form-control', 'readonly' => 'readonly' ]) }}
        </div>
        <div class="form-group">
          {{ Form::label('image', trans('admin.image')) }}
          @if (!empty($user->image))
            <img class="rounded m-2" src="{{Storage::url($user->image)}}" width="150" height="150" alt="image image" />
          @endif
          <div class="custom-file">
            {{ Form::file('image', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
            {{ Form::label('customFile', trans('admin.image'), ['class' => 'custom-file-label']) }}
          </div>
        </div>
        {{ Form::submit(trans('auth.update'), ['class' => 'btn btn-block'] )}}
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
