@extends('admin.index')
@section('content')
@push('js')
<script>
  $(document).ready(function () {
    // Copy Button
    $(document).on('click', '.copy_product', function (e) {
        e.preventDefault();
        // var formData = $('#product_form').serialize();
        $.ajax({
          url: "{{ aurl('product/copy/'.$product->id) }}",
          dataType: 'json',
          type: 'POST',
          data: { _token: '{{csrf_token()}}' },
          beforeSend: function () {
            $('.loading_copy_product').removeClass('d-none');
            $('.validate_message').html('');
            $('.error_messages').addClass('d-none');
            $('.success_messages').html('').addClass('d-none');
          },
          success: function(data) {
            $('.loading_copy_product').addClass('d-none');
            $('.success_messages').html('<div>'+data.message+'</div>').removeClass('d-none');
          },
          error: function(errors) {
            $('.loading_copy_product').addClass('d-none');
            var error_li = '';
            $.each(errors.responseJSON.errors, function(index, value) {
              error_li +='<li>' + value + '</li>';
            });
            $('.validate_message').html(error_li);
            $('.error_messages').removeClass('d-none');
          }
        });
      });
      // Save And Continue Button
      $(document).on('click', '.save_and_continue', function (e) {
        e.preventDefault();
        var formData = $('#product_form').serialize();
        $.ajax({
          url: "{{ aurl('product/'.$product->id) }}",
          dataType: 'json',
          type: 'POST',
          data: formData,
          beforeSend: function () {
            $('.loading_save_and_continue').removeClass('d-none');
            $('.validate_message').html('');
            $('.error_messages').addClass('d-none');
            $('.success_messages').html('').addClass('d-none');
          },
          success: function(data) {
            $('.loading_save_and_continue').addClass('d-none');
            $('.success_messages').html('<div>'+data.message+'</div>').removeClass('d-none');
          },
          error: function(errors) {
            $('.loading_save_and_continue').addClass('d-none');
            var error_li = '';
            $.each(errors.responseJSON.errors, function(index, value) {
              error_li +='<li>' + value + '</li>';
            });
            $('.validate_message').html(error_li);
            $('.error_messages').removeClass('d-none');
          }
        });
      });
  });
</script>
<script>delete_All();</script>
@endpush

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['url' => aurl('product'), 'method' => 'POST', 'files' => true, 'id' => 'product_form']) !!}
        {{ Form::hidden('_method', 'PUT') }}
        <div class="mb-3">
{{--          <a class="btn btn-primary text-white save">{{trans('admin.save')}}<i class="fa fa-save fa-fw"></i></a>--}}
          <a class="btn btn-success text-white save_and_continue">
            {{trans('admin.save_and_continue')}}
            <i class="fa fa-save fa-fw"></i>
            <i class="fa fa-spin fa-spinner fa-fw loading_save_and_continue d-none"></i>
          </a>
          <a class="btn btn-info text-white copy_product">
            {{trans('admin.copy_product')}}
            <i class="fa fa-copy fa-fw"></i>
            <i class="fa fa-spin fa-spinner fa-fw loading_copy_product d-none"></i>
          </a>
          <a class="btn btn-danger text-white delete" data-toggle="modal" data-target="#del_admin{{ $product->id }}">{{trans('admin.delete')}}<i class="fa fa-trash fa-fw"></i></a>
        </div>
        <div class="alert alert-danger error_messages d-none mb-3">
          <ul class="list-unstyled validate_message"></ul>
        </div>
        <div class="alert alert-success success_messages d-none mb-3"></div>
        <hr />
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="product_info-tab" data-toggle="tab" href="#product_info" role="tab" aria-controls="product_info" aria-selected="true">{{trans('admin.product_info')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="department-tab" data-toggle="tab" href="#department" role="tab" aria-controls="department" aria-selected="false">{{trans('admin.department')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="product_setting-tab" data-toggle="tab" href="#product_setting" role="tab" aria-controls="product_setting" aria-selected="false">{{trans('admin.product_setting')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="product_media-tab" data-toggle="tab" href="#product_media" role="tab" aria-controls="product_media" aria-selected="false">{{trans('admin.product_media')}}</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="product_size_weight-tab" data-toggle="tab" href="#product_size_weight" role="tab" aria-controls="product_size_weight" aria-selected="false">{{trans('admin.product_size_weight')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="other_data-tab" data-toggle="tab" href="#other_data" role="tab" aria-controls="other_data" aria-selected="false">{{trans('admin.other_data')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="relation_products-tab" data-toggle="tab" href="#relation_products" role="tab" aria-controls="relation_products" aria-selected="false">{{trans('admin.relation_products')}}</a>
            </li>
          </ul>
          <div class="tab-content mt-3" id="myTabContent">
            <h5 class="text-danger">{{trans('admin.fields-are-required')}}</h5>
            @include('admin.products.tabs.product_info')
            @include('admin.products.tabs.department')
            @include('admin.products.tabs.product_setting')
            @include('admin.products.tabs.product_media')
            @include('admin.products.tabs.product_size_weight')
            @include('admin.products.tabs.other_data')
            @include('admin.products.tabs.relation_products')
          </div>
          <div class="mb-3">
{{--            <a class="btn btn-primary text-white save">{{trans('admin.save')}}<i class="fa fa-save fa-fw"></i></a>--}}
            <a class="btn btn-success text-white save_and_continue">
              {{trans('admin.save_and_continue')}}
              <i class="fa fa-save fa-fw"></i>
              <i class="fa fa-spin fa-spinner fa-fw loading_save_and_continue d-none"></i>
            </a>
            <a class="btn btn-info text-white copy_product">
              {{trans('admin.copy_product')}}
              <i class="fa fa-copy fa-fw"></i>
              <i class="fa fa-spin fa-spinner fa-fw loading_copy_product d-none"></i>
            </a>
            <a href="#" class="btn btn-danger text-white delete" data-toggle="modal" data-target="#del_admin{{ $product->id }}">{{trans('admin.delete')}}<i class="fa fa-trash fa-fw"></i></a>
          </div>
            {{-- {{ Form::submit(trans('admin.save'), ['class' => 'btn btn-primary'] )}} --}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


  <div class="modal fade"  id="del_admin{{ $product->id }}" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body text-danger">
          <p class="not_empty_record">{{trans('admin.alert_delete_msg')}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">{{trans('admin.close')}}</button>
          {!! Form::open(['route' => ['product.destroy', $product->id], 'method' => 'POST']) !!}
              {{ Form::hidden('_method', 'DELETE') }}
              {{ Form::button(
                  trans('admin.delete'), [
                      'type' => 'submit',
                      'class' => 'btn btn-danger text-white delete btn-sm'
                  ])
              }}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>


@endsection
