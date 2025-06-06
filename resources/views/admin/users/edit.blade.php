@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => ['user.update', $user->id], 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{ Form::label('name', trans('admin.user_name')) }}
                {{ Form::text('name', $user->name, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('email', trans('admin.email')) }}
                {{ Form::email('email', $user->email, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('password', trans('admin.password')) }}
                {{ Form::password('password', ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('level', trans('admin.level')) }}
                {{ Form::select('level', [
                    'user' => trans('admin.user_level')
                ], $user->level ,['class' => 'form-control', 'placeholder' => '.......'] )}}
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
            {{ Form::hidden('_method', 'PUT') }}
            {{ Form::submit(trans('admin.save'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
