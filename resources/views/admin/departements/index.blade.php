@extends('admin.index')
@section('content')
@push('js')
<script>
  $(document).ready(function () {
    $('#jstree').jstree({
      "core" : {
          'data' : {!! load_departements() !!}
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
            name.push(data.instance.get_node(data.selected[i]).text);
        }
        $('.parent_id').val(r.join(', '));
        // Check If there is departement selected of not
        if (r.join(', ') != '') {
          $('.card-control').removeClass('d-none');
          $('.btn_edit').attr('href', "{{ aurl('departement') }}" + '/' + r.join(', ') + '/edit');
          $('#delete_form_button').attr('action', "{{ aurl('departement') }}" + '/' + r.join(', '));          
          $('.btn_delete').attr('onclick', "if(!confirm('{{trans('admin.alert_delete_dep_msg')}} ( " + name.join(', ') + " ) {{trans('admin.questionMark')}}')) return false;");                    
        } else {
          $('.card-control').addClass('d-none');
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
      <div class="card-control d-none mb-2">
        <a href="" class="btn btn-primary btn-sm btn_edit">{{ trans('admin.edit') }}</a>
        {!! Form::open(['method' => 'POST', 'id' => 'delete_form_button', 'class' => 'd-inline-block']) !!}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::button(
                'delete', [
                    'type' => 'submit', 
                    'class' => 'btn btn-danger btn-sm btn_delete'
                ]) 
            }}
        {!! Form::close() !!}
      </div>
      <div id="jstree"></div>    
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection