@extends('admin.index')
@section('content')

  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      {!! Form::open(['route' => ['page.update', $page->id], 'method' => 'POST']) !!}
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label('name_ar', trans('admin.page_name_ar')) }}
              {{ Form::text('name_ar', $page->name_ar, ['class' => 'form-control'] )}}
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label('name_en', trans('admin.page_name_en')) }}
              {{ Form::text('name_en', $page->name_en, ['class' => 'form-control'] )}}
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label('title_ar', trans('admin.page_title_ar')) }}
              {{ Form::text('title_ar', $page->title_ar, ['class' => 'form-control'] )}}
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label('title_en', trans('admin.page_title_en')) }}
              {{ Form::text('title_en', $page->title_en, ['class' => 'form-control'] )}}
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              {{ Form::label('content_ar', trans('admin.page_content_ar')) }}
              {{ Form::textarea('content_ar', $page->content_ar, ['class' => 'form-control', 'id' => 'content_ar'] )}}
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              {{ Form::label('content_en', trans('admin.page_content_en')) }}
              {{ Form::textarea('content_en', $page->content_en, ['class' => 'form-control', 'id' => 'content_en'] )}}
            </div>
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
@push('js')
  <script>
    var editor = CKEDITOR.replace('content_ar');
    CKFinder.setupCKEditor(editor);

    var editor1 = CKEDITOR.replace('content_en');
    CKFinder.setupCKEditor(editor1);
  </script>
@endpush
