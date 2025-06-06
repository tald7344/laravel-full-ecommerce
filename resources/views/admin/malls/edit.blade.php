@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBVyHUnq6KuUwzWK2rTpWQglTQrVxBS9YI'></script>
<script src="{{asset('/design/adminLte/dist/js/locationpicker.jquery.min.js')}}"></script>
<?php
$lat = !empty($mall->lat) ? $mall->lat : '-34.397';
$lng = !empty($mall->lng) ? $mall->lng : '150.644';

?>
<script>
    $('#us1').locationpicker({
        location: {
          latitude: {{ $lat }},
          longitude:{{ $lng }}
      },
      radius: 300,
      markerimage: '{{ url('design/adminlte/dist/img/map-marker-2-xl.png') }}',
      inputBinding: {
        latitudeInput: $('#lat'),
        longitudeInput: $('#lng'),
       // radiusInput: $('#us2-radius'),
        locationNameInput: $('#address')
      },
      enableAutocomplete: true,
  });
</script>
@endpush

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => ['mall.update', $mall->id], 'method' => 'POST', 'files' => true]) !!}
            <input type="hidden" value="{{ $lat }}" id="lat" name="lat">
            <input type="hidden" value="{{ $lng }}" id="lng" name="lng">
            <div class="form-group">
                {{ Form::label('malls_name_ar', trans('admin.malls_name_ar')) }}
                {{ Form::text('malls_name_ar', $mall->malls_name_ar, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('malls_name_en', trans('admin.malls_name_en')) }}
                {{ Form::text('malls_name_en', $mall->malls_name_en, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {!! Form::label('contact_name',trans('admin.contact_name')) !!}
                {!! Form::text('contact_name',$mall->contact_name,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', trans('admin.email')) !!}
                {!! Form::email('email', $mall->email, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('mobile', trans('admin.mobile')) !!}
                {!! Form::text('mobile', $mall->mobile, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
               {!! Form::label('country_id', trans('admin.country_id')) !!}
               {!! Form::select('country_id', App\Model\Country::pluck('countries_name_' . session('lang'), 'id'), $mall->country_id, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('address', trans('admin.address')) !!}
                {!! Form::text('address', $mall->address, ['class'=>'form-control address']) !!}
            </div>
            <div class="form-group">
                <div id="us1" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="form-group">
                {!! Form::label('facebook', trans('admin.facebook')) !!}
                {!! Form::text('facebook', $mall->facebook, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('twitter', trans('admin.twitter')) !!}
                {!! Form::text('twitter', $mall->twitter, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {{ Form::label('image', trans('admin.mall_image')) }}
                @if (!empty($mall->image))
                    <img class="rounded m-2" src="{{Storage::url($mall->image)}}" width="150" height="150" alt="image image" />
                @endif
                <div class="custom-file">
                    {{ Form::file('image', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
                    {{ Form::label('customFile', trans('admin.mall_image'), ['class' => 'custom-file-label']) }}
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
