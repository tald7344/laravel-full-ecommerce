<div class="tab-pane fade" id="product_size_weight" role="tabpanel" aria-labelledby="product_size_weight-tab">
	<h3>{{ trans('admin.product_size_weight') }}</h3>
	<div class="size_weight">
		<center><h1>{{ trans('admin.please_select_dep')}}</h1></center>
	</div>
	<div class="info_data d-none">
		<div class="row">
			<div class="col-12 col-md-4 form-group">
				{!! Form::label('color_id', trans('admin.color_id') ) !!}
				{!! Form::select('color_id', App\Model\Color::pluck('colors_name_' . session('lang'), 'id'), $product->color_id, ['class'=>'form-control', 'placeholder' => trans('admin.color_id')]) !!}
			</div>
			<div class="col-12 col-md-4 form-group">
				{!! Form::label('trade_id', trans('admin.trade_id') ) . ' <span class="text-danger font-weight-bold">*</span>' !!}
				{!! Form::select('trade_id', App\Model\TradeMark::pluck('trademarks_name_' . session('lang'), 'id'), $product->trade_id, ['class'=>'form-control', 'placeholder'=>trans('admin.trade_id')]) !!}
			</div>
			<div class="col-12 col-md-4 form-group">
				{!! Form::label('manufactory_id', trans('admin.manufactory_id') ) . ' <span class="text-danger font-weight-bold">*</span>' !!}
				{!! Form::select('manufactory_id', App\Model\Manufactory::pluck('manufactories_name_' . session('lang'), 'id'), $product->manufactory_id, ['class'=>'form-control', 'placeholder'=>trans('admin.manufactory_id')]) !!}
			</div>
      <div class="col-6 form-group">
        {!! Form::label('currency_id', trans('admin.country_id') ) . ' <span class="text-danger font-weight-bold">*</span>' !!}
        {!! Form::select('currency_id', App\Model\Country::pluck('countries_name_' . session('lang'), 'id'), $product->currency_id, ['class' => 'form-control', 'placeholder' => trans('admin.country_id')]) !!}
      </div>
			<div class="col-6 form-group">
				{!! Form::label('malls', trans('admin.malls')) . ' <span class="text-danger font-weight-bold">*</span>' !!}
				<select name="mall[]" class="form-control mall_select2" style="width: 100%" aria-label="Disabled select example" disabled></select>
			</div>
		</div>
	</div>
</div>
@push('js')
  <script>// In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
      $('#currency_id').change(function (e) {
        let country_id = e.target.value;
        $.ajax({
          url: '{{aurl('ajaxGetCountryDetails')}}',
          type: 'POST',
          data: {
            _token: '{{csrf_token()}}',
            country_id,
            product_id: '{{$product->id}}'
          },
          beforeSend: function () {
            $('.mall_select2').removeAttr('multiple');                  // remove multiple attribute
            $('.mall_select2').attr('disabled', 'disabled');            // add disabled attribute
          },
          error: function (response) {
            console.log(response);
            $('.mall_select2').html('');
            $('.mall_select2').removeAttr('multiple');                  // remove multiple attribute
            $('.mall_select2').attr('disabled', 'disabled');            // add disabled attribute
          },
          success: function (response, success) {
            if (success == 'success') {
              // clear select options
              $('.mall_select2').html('');
              $('.mall_select2').attr('multiple', 'multiple');      // add multiple attribute
              $('.mall_select2').removeAttr('disabled');            // remove disabled attribute

              // Insert new data to select tag
              $('.mall_select2').select2({
                data: response.result,
                placeholder: "{{trans('admin.select2MallPlaceholder')}}"
              });
            }
          }
        });
      });
    });
  </script>
@endpush
