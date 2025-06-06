@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => 'color.store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{ Form::label('colors_name_ar', trans('admin.colors_name_ar')) }}
                {{ Form::text('colors_name_ar', old('colors_name_ar'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('colors_name_en', trans('admin.colors_name_en')) }}
                {{ Form::text('colors_name_en', old('colors_name_en'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {!! Form::label('color',trans('admin.color')) !!}
                {!! Form::Color('color',old('color'),['class'=>'']) !!}
             </div>
            {{ Form::submit(trans('admin.new_color'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
