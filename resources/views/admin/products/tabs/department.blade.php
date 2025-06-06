{{-- @extends('admin.index') --}}
{{-- @section('content') --}}
@push('js')
	<script>
	  $(document).ready(function () {
		$('#jstree').jstree({
		  "core" : {
			  'data' : {!! load_departements( $product->department_id ) !!}
		  },
		  "checkbox" : {
			  "keep_selected_style" : false
		  },
		  "plugins" : [ "wholerow" ]
		});
		$('#jstree').on("changed.jstree", function (e, data) {
			var i, j, r = [];
			var hasChildren = null;
			for (i = 0, j = data.selected.length; i < j; i++) {
				r.push(data.instance.get_node(data.selected[i]).id);
				hasChildren = data.instance.get_node(data.selected[i]).original.has_children;
			}

			// Check If there is departement selected of not
			if (r.join(', ') != '') {
			  if (!hasChildren) {
          console.log('dont has child');
          var department = r.join(', ');
          $('.department_id').val(department);
        } else {
          $('.department_id').val('');
          $('#custom-message').addClass('show');
          $('#custom-message .message-text').html('{{ trans('admin.prevent-select-category-has-child-msg') }}');
        }

				$.ajax({
					url: "{{ aurl('load/weight/size') }}",
					dataType: 'html',
					type: 'POST',
					data: { _token: '{{csrf_token()}}', dep_id: department, product_id: '{{ $product->id }}' },
					success: function(data) {
						$('.size_weight').html(data);
						$('.info_data').removeClass('d-none');
					}
				});
			}

		});
	  });
	</script>
@endpush

<div class="tab-pane fade" id="department" role="tabpanel" aria-labelledby="department-tab">
	<h3>{{ trans('admin.product_info') }}</h3>

	<div class="card">
		<div class="card-header">
		<h3 class="card-title" style="float:none;">{{ $title }}</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
	 	  {{ Form::hidden('department_id', old('department_id'), ['class' => 'department_id']) }}
		  <div id="jstree"></div>
		</div>
		<!-- /.card-body -->
	  </div>
	  <!-- /.card -->



</div>
{{-- @endsection --}}
