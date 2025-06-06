@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => 'trademark.store', 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{ Form::label('trademarks_name_ar', trans('admin.trademarks_name_ar')) }}
                {{ Form::text('trademarks_name_ar', old('trademarks_name_ar'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('trademarks_name_en', trans('admin.trademarks_name_en')) }}
                {{ Form::text('trademarks_name_en', old('trademarks_name_en'), ['class' => 'form-control'] )}}
            </div>
	        <div class="form-group">
                {{ Form::label('logo', trans('admin.logo')) }}
                <div class="custom-file">
                    {{ Form::file('logo', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
                    {{ Form::label('customFile', trans('admin.logo'), ['class' => 'custom-file-label']) }}
                </div>
            </div>
            {{ Form::submit(trans('admin.new_trademark'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
