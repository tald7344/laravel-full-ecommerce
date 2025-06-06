@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places&key=google_api_key'></script>
<script src="{{asset('/design/adminLte/dist/js/locationpicker.jquery.min.js')}}"></script>
<?php
$lat = !empty($shipping->lat) ? $shipping->lat : '-34.397';
$lng = !empty($shipping->lng) ? $shipping->lng : '150.644';

?>
<script>
    $('#us1').locationpicker({
        location: {
          latitude: {{ $lat }},
          longitude:{{ $lng }}
      },
      radius: 300,
      markerIcon: '{{ url('design/adminlte/dist/img/map-marker-2-xl.png') }}',
      inputBinding: {
        latitudeInput: $('#lat'),
        longitudeInput: $('#lng'),
       // radiusInput: $('#us2-radius'),
        locationNameInput: $('#address')
      }
  });
</script>
@endpush

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => ['shipping.update', $shipping->id], 'method' => 'POST', 'files' => true]) !!}
            <input type="hidden" value="{{ $lat }}" id="lat" name="lat">
            <input type="hidden" value="{{ $lng }}" id="lng" name="lng">
            <div class="form-group">
                {{ Form::label('shippings_name_ar', trans('admin.shippings_name_ar')) }}
                {{ Form::text('shippings_name_ar', $shipping->shippings_name_ar, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('shippings_name_en', trans('admin.shippings_name_en')) }}
                {{ Form::text('shippings_name_en', $shipping->shippings_name_en, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {!! Form::label('user_id',trans('admin.user_id')) !!}
                {!! Form::select('user_id', App\User::where('level', 'company')->pluck('name', 'id'), $shipping->user_id, ['class'=>'form-control']) !!}
             </div>
            <div class="form-group">
                <div id="us1" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="form-group">
                {{ Form::label('icon', trans('admin.shipping_icon')) }}
                @if (!empty($shipping->icon))
                    <img class="rounded m-2" src="{{Storage::url($shipping->icon)}}" width="50" height="50" alt="Icon image" />
                @endif
                <div class="custom-file">
                    {{ Form::file('icon', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
                    {{ Form::label('customFile', trans('admin.shipping_icon'), ['class' => 'custom-file-label']) }}
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
