@push('js')
	<script>
		var x = 1;
		$(document).on('click', '.add_input', function(e) {
			e.preventDefault();
			var max_inputs = 10;
			if (x < max_inputs) {
				$('.div_inputs').append('<div class="row form-group">' +
						'<div class="col-12 col-sm-6">' +
							'{!! Form::label("input_keys_ar", trans("admin.input_keys_ar")) !!}' +
							'{!! Form::text("input_keys_ar[]", "", ["class" => "form-control", 'placeholder' => trans('admin.ex_input_keys_ar')]) !!}' +
						'</div>' +
            '<div class="col-12 col-sm-6">' +
              '{!! Form::label("input_keys_en", trans("admin.input_keys_en")) !!}' +
              '{!! Form::text("input_keys_en[]", "", ["class" => "form-control", 'placeholder' => trans('admin.ex_input_keys_en')]) !!}' +
            '</div>' +
						'<div class="col-11">' +
							'{!! Form::label("input_values", trans("admin.input_values")) !!}' +
							'{!! Form::text("input_values[]", "", ["class" => "form-control"]) !!}' +
						'</div>' +
						'<div class="col-1 text-center" style="align-self: flex-end">' +
							'<a href="#" class="btn btn-danger remove_input"><i class="fa fa-trash fa-fw"></i></a>' +
						'</div>' +
            '<div class="col-12 mt-3 mb-2"><hr></div>' +
					'</div>');
				x++;
			}

		});
		$(document).on('click', '.remove_input', function (e) {
			e.preventDefault();
			x--;
			$(this).parent('div').parent('div').remove();
		});
	</script>
@endpush
<div class="tab-pane fade" id="other_data" role="tabpanel" aria-labelledby="other_data-tab">
	<h3>{{ trans('admin.product_info') }}</h3>
	<div class="div_inputs">
		<div class="row form-group">
			@if (count($product->otherData()->get()) != 0)
				@foreach($product->otherData()->get() as $otherData)
					<div class="col-12 col-sm-6">
						{{ Form::label('input_keys_ar', trans('admin.input_keys_ar')) }}
						{{ Form::text('input_keys_ar[]', $otherData->data_key_ar, ['class' => 'form-control', 'placeholder' => trans('admin.ex_input_keys_ar')]) }}
					</div>
          <div class="col-12 col-sm-6">
            {{ Form::label('input_keys_en', trans('admin.input_keys_en')) }}
            {{ Form::text('input_keys_en[]', $otherData->data_key_en, ['class' => 'form-control', 'placeholder' => trans('admin.ex_input_keys_en')]) }}
          </div>
					<div class="col-11">
						{{ Form::label('input_values', trans('admin.input_values')) }}
						{{ Form::text('input_values[]', $otherData->data_value, ['class' => 'form-control']) }}
					</div>
					<div class="col-1 text-center" style="align-self: flex-end">
						<a href="#" class="btn btn-danger remove_input"><i class="fa fa-trash fa-fw"></i></a>
					</div>
          <div class="col-12 mt-3 mb-2">
            <hr>
          </div>
				@endforeach
			@else
				<div class="col-12 col-sm-6">
					{{ Form::label('input_keys_ar', trans('admin.input_keys_ar')) }}
					{{ Form::text('input_keys_ar[]', old('input_keys_ar'), ['class' => 'form-control', 'placeholder' => trans('admin.ex_input_keys_ar')]) }}
				</div>
        <div class="col-12 col-sm-6">
          {{ Form::label('input_keys_en', trans('admin.input_keys_en')) }}
          {{ Form::text('input_keys_en[]', old('input_keys_en'), ['class' => 'form-control', 'placeholder' => trans('admin.ex_input_keys_en')]) }}
        </div>
				<div class="col-11">
					{{ Form::label('input_values', trans('admin.input_values')) }}
					{{ Form::text('input_values[]', old('input_values'), ['class' => 'form-control']) }}
				</div>
				<div class="col-1 text-center" style="align-self: flex-end">
					<a href="#" class="btn btn-danger remove_input"><i class="fa fa-trash fa-fw"></i></a>
				</div>
        <div class="col-12 mt-3 mb-2">
          <hr>
        </div>
			@endif
		</div>
	</div>
	<a href="#" class="btn btn-info my-3 add_input" title="{{ trans('admin.add_input')}}"><i class="fa fa-plus fa-fw"></i></a>
</div>
