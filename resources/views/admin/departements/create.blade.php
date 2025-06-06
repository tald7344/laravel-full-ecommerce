@extends('admin.index')
@section('content')
@push('js')
<script>
  $(document).ready(function () {
    $('#jstree').jstree({
      "core" : {
          'data' : {!! load_departements(old('parent')) !!}
      },
      "checkbox" : {
        "keep_selected_style" : false
      },
      "plugins" : [ "wholerow" ]
    });
    $('#jstree').on("changed.jstree", function (e, data) {
        var i, j, r = [];
        for (i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).id);
        }
        $('.parent_id').val(r.join(', '));
    });
  });
</script>
@endpush

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => 'departement.store', 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{ Form::label('dep_name_ar', trans('admin.dep_name_ar')) }}
                {{ Form::text('dep_name_ar', old('dep_name_ar'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('dep_name_en', trans('admin.dep_name_en')) }}
                {{ Form::text('dep_name_en', old('dep_name_en'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                <p class="mb-3">{{ trans('admin.select_dep_create_note')}} <span class="text-warning">( {{ trans('admin.keep_with_three_levels_note') }} )</span></p>
                <div id="jstree"></div>
            </div>
            {{ Form::hidden('parent', old('parent'), ['class' => 'parent_id']) }}
            {{-- <input type="hidden" name="parent" class="parent_id" value="{{old('parent')}}"> --}}
            <div class="form-group">
                {{ Form::label('description', trans('admin.dep_desc')) }}
                {{ Form::text('description', old('description'), ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{ Form::label('keywords', trans('admin.keywords')) }}
                {{ Form::text('keywords', old('keywords'), ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{ Form::label('icon', trans('admin.dep_icon')) }}
                <div class="custom-file">
                    {{ Form::file('icon', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
                    {{ Form::label('customFile', trans('admin.dep_icon'), ['class' => 'custom-file-label']) }}
                </div>
            </div>

            {{ Form::submit(trans('admin.new_departement'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
