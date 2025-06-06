@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => 'menu.store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{ Form::label('name_ar', trans('admin.menu_name_ar')) }}
                {{ Form::text('name_ar', old('name_ar'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('name_en', trans('admin.menu_name_en')) }}
                {{ Form::text('name_en', old('name_en'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
              {{ Form::label('parent', trans('admin.menu_parent')) }}
              {{ Form::select('parent', \App\Model\Menu::pluck('name_' . session('lang'), 'id')->prepend(trans('admin.select-menu'), 0), old('parent'), ['class' => 'form-control'] )}}
            </div>
            {{ Form::submit(trans('admin.new_menu'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
