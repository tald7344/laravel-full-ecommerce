@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => ['link.update', $link->id], 'method' => 'POST']) !!}
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                {!!  Form::label('link_name_ar', trans('admin.link_name_ar')) . ' <span class="text-danger font-weight-bold">*</span>'  !!}
                {{ Form::text('link_name_ar', $link->link_name_ar, ['class' => 'form-control'] )}}
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                {!! Form::label('link_name_en', trans('admin.link_name_en')) . ' <span class="text-danger font-weight-bold">*</span>'  !!}
                {{ Form::text('link_name_en', $link->link_name_en, ['class' => 'form-control'] ) }}
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                {!! Form::label('menu_id', trans('admin.menu')) . ' <span class="text-danger font-weight-bold">*</span>'  !!}
                {{ Form::select('menu_id', \App\Model\Menu::pluck('name_' . session('lang'), 'id'), $link->menu_id, ['class' => 'form-control'] ) }}
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                {{ Form::label('parent', trans('admin.menu_parent')) }}
                {{ Form::select('parent', \App\Model\Link::where('id', '!=', $link->id)->pluck('link_name_' . session('lang'), 'id')->prepend(trans('admin.select-link'), 0), $link->parent, ['class' => 'form-control'] ) }}
              </div>
            </div>
            <div class="col-12 {{$link->hasLink == 1 ? 'col-md-6' : ''}}" id="has_link">
              <div class="form-group">
                {!! Form::label('hasLink', trans('admin.HasLink')) . ' <span class="text-danger font-weight-bold">*</span>'  !!}
                {{ Form::select('hasLink', ['0' => trans('admin.no'), '1' => trans('admin.yes')], $link->hasLink, ['class' => 'form-control', 'id' => 'has_link'] ) }}
              </div>
            </div>
            <div class="col-12 col-md-6 {{$link->hasLink == 0 ? 'd-none' : ''}}" id="link_url">
              <div class="form-group">
                {!! Form::label('url', trans('admin.url')) . ' <span class="text-danger font-weight-bold">*</span>'  !!}
                {{ Form::text('url', $link->url, ['class' => 'form-control'] )}}
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                {{ Form::label('link_content_ar', trans('admin.link_content_ar')) }}
                {{ Form::textarea('link_content_ar', $link->link_content_ar, ['class' => 'form-control'] )}}
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                {{ Form::label('link_content_en', trans('admin.link_content_en')) }}
                {{ Form::textarea('link_content_en', $link->link_content_en, ['class' => 'form-control'] )}}
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
    // Editor Tools
    var editor22 = CKEDITOR.replace('link_content_ar');
    CKFinder.setupCKEditor(editor22);
    var editor11 = CKEDITOR.replace('link_content_en');
    CKFinder.setupCKEditor(editor11);

    // display url input
    document.getElementById('has_link').onchange = function (e) {
      if (e.target.value == 1) {
        document.getElementById('link_url').classList.remove('d-none');
        document.getElementById('has_link').classList.add('col-md-6');
      } else {
        document.getElementById('link_url').classList.add('d-none');
        document.getElementById('has_link').classList.remove('col-md-6');
      }
    }
  </script>
@endpush

