@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => ['trademark.update', $trademark->id], 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{ Form::label('trademarks_name_ar', trans('admin.trademarks_name_ar')) }}
                {{ Form::text('trademarks_name_ar', $trademark->trademarks_name_ar, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('trademarks_name_en', trans('admin.trademarks_name_en')) }}
                {{ Form::text('trademarks_name_en', $trademark->trademarks_name_en, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
              <div class="my-2">
                {{ Form::label('logo', trans('admin.logo')) }}
                @if (!empty($trademark->logo))
                  <img class="mx-3" width="150" height="100" src="{{ Storage::url($trademark->logo) }}" alt="" />
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
