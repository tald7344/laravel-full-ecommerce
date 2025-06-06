@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => 'city.store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{ Form::label('cities_name_ar', trans('admin.cities_name_ar')) }}
                {{ Form::text('cities_name_ar', old('cities_name_ar'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('cities_name_en', trans('admin.cities_name_en')) }}
                {{ Form::text('cities_name_en', old('cities_name_en'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('country_id', trans('admin.country_id')) }}
                {{ Form::select('country_id', App\Model\Country::pluck('countries_name_' . session('lang'), 'id'), old('country_id'), ['class' => 'form-control'] )}}
            </div>

            {{ Form::submit(trans('admin.new_city'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
