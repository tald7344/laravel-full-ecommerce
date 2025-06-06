@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => ['country.update', $country->id], 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{ Form::label('countries_name_ar', trans('admin.countries_name_ar')) }}
                {{ Form::text('countries_name_ar', $country->countries_name_ar, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('countries_name_en', trans('admin.countries_name_en')) }}
                {{ Form::text('countries_name_en', $country->countries_name_en, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('mob', trans('admin.mob')) }}
                {{ Form::text('mob', $country->mob, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('code', trans('admin.code')) }}
                {{ Form::text('code', $country->code, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('currency', trans('admin.currency')) }}
                {{ Form::text('currency', $country->currency, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                <div class="my-2">
                  {{ Form::label('logo', trans('admin.logo')) }}
                  @if (!empty($country->logo))
                    <img class="mx-3" width="75" height="75" src="{{ Storage::url($country->logo) }}" alt="" />
                  @endif
                </div>
                <div class="custom-file">
                    {{ Form::file('logo', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
                    {{ Form::label('customFile', trans('admin.logo'), ['class' => 'custom-file-label']) }}
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
