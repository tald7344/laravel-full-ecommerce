@push('js')
<script type="text/javascript">
$('.datepicker').datepicker({
	rtl:'{{ session('lang') == 'ar' ? true : false }}',
	language:'{{ session('lang') }}',
	format:'yyyy-mm-dd',
	autoclose:false,
	todayBtn:true,
	clearBtn:true
});

$(document).on('change', '.status', function () {
	var statusVal = $('.status option:selected').val();
	if (statusVal == 'refused') {
		$('.reason').removeClass('d-none');
	} else {
		$('.reason').addClass('d-none');
	}
});
</script>
@endpush
<div class="tab-pane fade" id="product_setting" role="tabpanel" aria-labelledby="product_setting-tab">
	<h3>{{ trans('admin.product_info') }}</h3>
	<div class="row">
		<div class="col-12 col-sm-6 col-md-3 form-group">
			{!! Form::label('price',trans('admin.price')) . ' <span class="text-danger font-weight-bold">*</span>' !!}
			{!! Form::number('price',$product->price,['class'=>'form-control','placeholder'=>trans('admin.price')]) !!}
		</div>
		<div class="col-12 col-sm-6 col-md-3 form-group">
			{!! Form::label('stock', trans('admin.stock')) . ' <span class="text-danger font-weight-bold">*</span>' !!}
			{!! Form::text('stock', $product->stock,['class'=>'form-control','placeholder'=>trans('admin.stock')]) !!}
		</div>
		<div class="col-12 col-sm-6 col-md-3 form-group">
			{!! Form::label('start_at',trans('admin.start_at')) !!}
			{!! Form::text('start_at',$product->start_at, ['class'=>'form-control datepicker', 'placeholder'=>trans('admin.start_at'), 'autocomplete'=>'off']) !!}
		</div>
		<div class="col-12 col-sm-6 col-md-3 form-group">
			{!! Form::label('end_at',trans('admin.end_at')) !!}
			{!! Form::text('end_at',$product->end_at,['class'=>'form-control datepicker','placeholder'=>trans('admin.end_at'), 'autocomplete'=>'off']) !!}
		</div>
		<div class="col-12 col-sm-6 col-md-4 form-group">
			{!! Form::label('price_offer',trans('admin.price_offer')) !!}
			{!! Form::number('price_offer',$product->price_offer, ['class'=>'form-control', 'placeholder'=>trans('admin.price_offer')]) !!}
		</div>
		<div class="col-12 col-sm-6 col-md-4 form-group">
			{!! Form::label('start_offer_at',trans('admin.start_offer_at')) !!}
			{!! Form::text('start_offer_at',$product->start_offer_at, ['class'=>'form-control datepicker', 'placeholder'=>trans('admin.start_offer_at'), 'autocomplete'=>'off']) !!}
		</div>
		<div class="col-12 col-sm-6 col-md-4 form-group">
			{!! Form::label('end_offer_at',trans('admin.end_offer_at')) !!}
			{!! Form::text('end_offer_at',$product->end_offer_at,['class'=>'form-control datepicker', 'placeholder'=>trans('admin.end_offer_at'), 'autocomplete'=>'off']) !!}
		</div>
		<div class="col-12 form-group">
			{!! Form::label('status',trans('product.status')) !!}
			{!! Form::select('status',[
				'pending' => trans('admin.pending'),
				'refused' => trans('admin.refused'),
				'active' => trans('admin.active'),
			], $product->status, ['class'=>'form-control status']) !!}
		</div>
		<div class="col-12 form-group reason {{ $product->status != 'refused' ? 'd-none' : ''}}">
			{!! Form::label('reason',trans('admin.refused_reason')) !!}
			{!! Form::textarea('reason', $product->reason, ['class'=>'form-control']) !!}
		</div>
	</div>
</div>
