@extends('admin.index')
@section('content')
@push('js')
<script>
  $(document).ready(function () {
    $('#jstree').jstree({
      "core" : {
          'data' : {!! load_departements($departement->parent,$departement->id) !!}
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
        {!! Form::open(['route' => ['departement.update', $departement->id], 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{ Form::label('dep_name_ar', trans('admin.dep_name_ar')) }}
                {{ Form::text('dep_name_ar', $departement->dep_name_ar, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('dep_name_en', trans('admin.dep_name_en')) }}
                {{ Form::text('dep_name_en', $departement->dep_name_en, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                <p class="mb-3">{{ trans('admin.select_dep_edit_note')}}</p>
                <div id="jstree"></div>
            </div>
            {{ Form::hidden('parent', $departement->parent, ['class' => 'parent_id']) }}
            {{-- <input type="hidden" name="parent" class="parent_id" value="{{$departement->parent}}"> --}}
            <div class="form-group">
                {{ Form::label('description', trans('admin.description')) }}
                {{ Form::textarea('description', $departement->description, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{ Form::label('keywords', trans('admin.keywords')) }}
                {{ Form::textarea('keywords', $departement->keywords, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{ Form::label('icon', trans('admin.dep_icon')) }}
                @if (!empty($departement->icon))
                    <img class="rounded m-2" src="{{Storage::url($departement->icon)}}" width="50" height="50" alt="Icon image" />
                @endif
                <div class="custom-file">
                    {{ Form::file('icon', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
                    {{ Form::label('customFile', trans('admin.dep_icon'), ['class' => 'custom-file-label']) }}
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
