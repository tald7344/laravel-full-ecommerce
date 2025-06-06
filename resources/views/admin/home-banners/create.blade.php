
@extends('admin.index')
@section('content')

  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      {!! Form::open(['route' => 'home-banner.store', 'method' => 'POST', 'files' => true]) !!}
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label('title_ar', trans('admin.banner_title_ar')) }}
              {{ Form::text('title_ar', old('title_ar'), ['class' => 'form-control', 'placeholder' => trans('admin.banner_title_ar')] )}}
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label('title_en', trans('admin.banner_title_en')) }}
              {{ Form::text('title_en', old('title_en'), ['class' => 'form-control', 'placeholder' => trans('admin.banner_title_en')] )}}
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label('content_ar', trans('admin.banner_content_ar')) }}
              {{ Form::textarea('content_ar', old('content_ar'), ['class' => 'form-control', 'placeholder' => trans('admin.banner_content_ar')] )}}
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label('content_en', trans('admin.banner_content_en')) }}
              {{ Form::textarea('content_en', old('content_en'), ['class' => 'form-control', 'placeholder' => trans('admin.banner_content_en')] )}}
            </div>
          </div>
        </div>


        <div class="form-group">
          {{ Form::label('image', trans('admin.image')) }}
          <div class="custom-file">
            {{ Form::file('image', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
            {{ Form::label('customFile', trans('admin.image'), ['class' => 'custom-file-label']) }}
          </div>
        </div>
        {{ Form::submit(trans('admin.new_banner'), ['class' => 'btn btn-primary'] )}}
      {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
