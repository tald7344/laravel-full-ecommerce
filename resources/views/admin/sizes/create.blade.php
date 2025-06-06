

@extends('admin.index')
@section('content')
@push('js')
<script>
  $(document).ready(function () {
    $('#jstree').jstree({
      "core" : {
          'data' : {!! load_departements(old('department_id')) !!}
      },
      "checkbox" : {
        "keep_selected_style" : false
      },
      "plugins" : [ "wholerow" ]
    });
    $('#jstree').on("changed.jstree", function (e, data) {
        var i, j, r = [];
        var name = [];
        for (i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).id);
        }
        // Check If there is departement selected of not
        if (r.join(', ') != '') {
            $('.department_id_class').val(r.join(', '));
        }
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
        {!! Form::open(['route' => 'size.store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{ Form::label('sizes_name_ar', trans('admin.sizes_name_ar')) }}
                {{ Form::text('sizes_name_ar', old('sizes_name_ar'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('sizes_name_en', trans('admin.sizes_name_en')) }}
                {{ Form::text('sizes_name_en', old('sizes_name_en'), ['class' => 'form-control'] )}}
            </div>

            <div class="form-group">
                <p class="mb-3">{{ trans('admin.select_dep_create_note')}}</p>
                <div id="jstree"></div>
            </div>
            {{ Form::hidden('department_id', old('department_id'), ['class' => 'department_id_class']) }}
            <div class="form-group">
                {!! Form::label('is_public', trans('admin.is_public')) !!}
                {!! Form::select('is_public', [
                    'yes' => trans('admin.yes'),
                    'no' => trans('admin.no')
                ],old('is_public'), ['class'=> 'form-control']) !!}
             </div>
            {{ Form::submit(trans('admin.new_size'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
