@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => 'country.store', 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{ Form::label('countries_name_ar', trans('admin.countries_name_ar')) }}
                {{ Form::text('countries_name_ar', old('countries_name_ar'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('countries_name_en', trans('admin.countries_name_en')) }}
                {{ Form::text('countries_name_en', old('countries_name_en'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('mob', trans('admin.mob')) }}
                {{ Form::text('mob', old('mob'), ['class' => 'form-control', 'placeholder' => trans('admin.forExmple') . ' 963'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('code', trans('admin.code')) }}
                {{ Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => trans('admin.forExmple') . ' SY'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('currency', trans('admin.currency')) }}
                {{ Form::text('currency', old('currency'), ['class' => 'form-control'] )}}
            </div>
	        <div class="form-group">
                {{ Form::label('logo', trans('admin.logo')) }}
                <div class="custom-file">
                    {{ Form::file('logo', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
                    {{ Form::label('customFile', trans('admin.logo'), ['class' => 'custom-file-label']) }}
                </div>
            </div>
            {{ Form::submit(trans('admin.new_country'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
