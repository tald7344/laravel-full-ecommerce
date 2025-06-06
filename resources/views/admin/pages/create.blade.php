@extends('admin.index')
@section('content')
<style>
  .ck-editor__editable[role="textbox"] {
    /* editing area */
    min-height: 200px;
  }
  .ck-content .image {
    /* block images */
    max-width: 80%;
    margin: 20px auto;
  }
</style>
<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => 'page.store', 'method' => 'POST']) !!}
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  {{ Form::label('name_ar', trans('admin.page_name_ar')) }}
                  {{ Form::text('name_ar', old('name_ar'), ['class' => 'form-control'] )}}
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  {{ Form::label('name_en', trans('admin.page_name_en')) }}
                  {{ Form::text('name_en', old('name_en'), ['class' => 'form-control'] )}}
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  {{ Form::label('title_ar', trans('admin.page_title_ar')) }}
                  {{ Form::text('title_ar', old('title_ar'), ['class' => 'form-control'] )}}
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  {{ Form::label('title_en', trans('admin.page_title_en')) }}
                  {{ Form::text('title_en', old('title_en'), ['class' => 'form-control'] )}}
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  {{ Form::label('content_ar', trans('admin.page_content_ar')) }}
                  {{ Form::textarea('content_ar', old('content_ar'), ['class' => 'form-control', 'id' => 'content_ar'] )}}
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  {{ Form::label('content_en', trans('admin.page_content_en')) }}
                  {{ Form::textarea('content_en', old('content_en'), ['class' => 'form-control', 'id' => 'content_en'] )}}
                </div>
              </div>
            </div>
            {{ Form::submit(trans('admin.new_page'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection

@push('js')
  <script>
    var editorContentAr = CKEDITOR.replace('content_ar', {
      filebrowserUploadUrl: "{{ aurl('page/ckeditor/upload?_token=' . csrf_token()) }}",
      filebrowserUploadMethod: 'form'
    });
    CKFinder.setupCKEditor(editorContentAr);
    var editorContentEn = CKEDITOR.replace('content_en', {
      filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
    });
    CKFinder.setupCKEditor(editorContentEn);
  </script>
@endpush
