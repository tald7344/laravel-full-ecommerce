@extends('admin.index')

@section('content')

{{-- {{ setting() }} --}}
<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['url' => aurl('settings/save'), 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{ Form::label('sitename_ar', trans('admin.sitename_ar')) }}
                {{ Form::text('sitename_ar', setting()->sitename_ar, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{ Form::label('sitename_en', trans('admin.sitename_en')) }}
                {{ Form::text('sitename_en', setting()->sitename_en, ['class' => 'form-control'])}}
            </div>
	        <div class="form-group">
                {{ Form::label('logo', trans('admin.logo')) }}
                @if (!empty(setting()->logo))
                    <img class="rounded m-2" src="{{Storage::url(setting()->logo)}}" width="50" height="50" alt="logo image" />
                @endif
                <div class="custom-file">
                    {{ Form::file('logo', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
                    {{ Form::label('customFile', trans('admin.logo'), ['class' => 'custom-file-label']) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('icon', trans('admin.icon')) }}
                @if (!empty(setting()->icon))
                    <img class="rounded m-2" src="{{Storage::url(setting()->icon)}}" width="50" height="50" alt="Icon image" />
                @endif
                <div class="custom-file">
                    {{ Form::file('icon', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
                    {{ Form::label('customFile', trans('admin.icon'), ['class' => 'custom-file-label']) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('email', trans('admin.email')) }}
                {{ Form::email('email', setting()->email, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{ Form::label('default_lang', trans('admin.default_lang')) }}
                {{ Form::select('default_lang', [
                    'ar' => trans('admin.arabic'),
                    'en' => trans('admin.english')
                ], setting()->default_lang, ['class' => 'form-control', 'placeholder' => '....'])}}
            </div>
            <div class="form-group">
                {{ Form::label('description', trans('admin.description')) }}
                {{ Form::textarea('description', setting()->description, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{ Form::label('keywords', trans('admin.keywords')) }}
                {{ Form::textarea('keywords', setting()->keywords, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
              {!! Form::label('menu_control', trans('admin.menu_control')) . '<span class="text-danger"> ( ' . trans('admin.developer_note_active') . ' )</span>' !!}
              {{ Form::select('menu_control', [
                  'hide' => trans('admin.hide'),
                  'show' => trans('admin.show')
              ], setting()->menu_control, ['class' => 'form-control', 'placeholder' => '....'])}}
            </div>
            <div class="form-group">
                {{ Form::label('status', trans('admin.status')) }}
                {{ Form::select('status', [
                    'open' => trans('admin.open'),
                    'close' => trans('admin.close')
                ], setting()->status, ['class' => 'form-control', 'placeholder' => '....'])}}
            </div>
            <div class="form-group">
                {{ Form::label('message_maintenance', trans('admin.message_maintenance')) }}
                {{ Form::textarea('message_maintenance', setting()->message_maintenance, ['class' => 'form-control'])}}
            </div>
            {{ Form::submit(trans('admin.save'), ['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection
