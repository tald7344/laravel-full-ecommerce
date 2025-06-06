
<div class="tab-pane fade show active" id="product_info" role="tabpanel" aria-labelledby="product_info-tab">
	<h3>{{ trans('admin.product_info') }}</h3>
  <div class="row">
    <div class="col-6 form-group">
      {!! Form::label('title_ar',trans('admin.title_ar') ) . ' <span class="text-danger font-weight-bold">*</span>' !!}
      {!! Form::text('title_ar', $product->title_ar, ['class'=>'form-control', 'placeholder' => trans('admin.title_ar')]) !!}
    </div>
    <div class="col-6 form-group">
      {!! Form::label('title_en',trans('admin.title_en')) . ' <span class="text-danger font-weight-bold">*</span>' !!}
      {!! Form::text('title_en', $product->title_en, ['class'=>'form-control', 'placeholder' => trans('admin.title_en')]) !!}
    </div>
    <div class="col-6 form-group">
      {!! Form::label('content_ar',trans('admin.content_ar')) . ' <span class="text-danger font-weight-bold">*</span>' !!}
      {!! Form::textarea('content_ar', $product->content_ar, ['class'=>'form-control', 'placeholder' => trans('admin.content_ar')]) !!}
    </div>
    <div class="col-6 form-group">
      {!! Form::label('content_en',trans('admin.content_en')) . ' <span class="text-danger font-weight-bold">*</span>' !!}
      {!! Form::textarea('content_en', $product->content_en, ['class'=>'form-control', 'placeholder' => trans('admin.content_en')]) !!}
    </div>
  </div>
</div>
