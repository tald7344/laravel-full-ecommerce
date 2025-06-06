@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => 'user.store', 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{ Form::label('name', trans('admin.user_name')) }}
                {{ Form::text('name', old('name'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('email', trans('admin.email')) }}
                {{ Form::email('email', old('email'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('password', trans('admin.password')) }}
                {{ Form::password('password', ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('level', trans('admin.level')) }}
                {{ Form::select('level', [
                    'user' => trans('admin.user_level')
                ], 'user' ,['class' => 'form-control', 'placeholder' => '.......'] )}}
            </div>
            <div class="form-group">
              {{ Form::label('image', trans('admin.image')) }}
              <div class="custom-file">
                {{ Form::file('image', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
                {{ Form::label('customFile', trans('admin.image'), ['class' => 'custom-file-label']) }}
              </div>
            </div>
            {{ Form::submit(trans('admin.new_user'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
