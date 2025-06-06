@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => 'weight.store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{ Form::label('weights_name_ar', trans('admin.weights_name_ar')) }}
                {{ Form::text('weights_name_ar', old('weights_name_ar'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('weights_name_en', trans('admin.weights_name_en')) }}
                {{ Form::text('weights_name_en', old('weights_name_en'), ['class' => 'form-control'] )}}
            </div>
            {{ Form::submit(trans('admin.new_weight'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
