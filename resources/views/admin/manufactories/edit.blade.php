@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBVyHUnq6KuUwzWK2rTpWQglTQrVxBS9YI'></script>
<script src="{{asset('/design/adminLte/dist/js/locationpicker.jquery.min.js')}}"></script>
<?php
$lat = !empty($manufactory->lat) ? $manufactory->lat : '-34.397';
$lng = !empty($manufactory->lng) ? $manufactory->lng : '150.644';

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
        {!! Form::open(['route' => ['manufactory.update', $manufactory->id], 'method' => 'POST', 'files' => true]) !!}
            <input type="hidden" value="{{ $lat }}" id="lat" name="lat">
            <input type="hidden" value="{{ $lng }}" id="lng" name="lng">
            <div class="form-group">
                {{ Form::label('manufactories_name_ar', trans('admin.manufactories_name_ar')) }}
                {{ Form::text('manufactories_name_ar', $manufactory->manufactories_name_ar, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {{ Form::label('manufactories_name_en', trans('admin.manufactories_name_en')) }}
                {{ Form::text('manufactories_name_en', $manufactory->manufactories_name_en, ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
                {!! Form::label('contact_name',trans('admin.contact_name')) !!}
                {!! Form::text('contact_name',$manufactory->contact_name,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', trans('admin.email')) !!}
                {!! Form::email('email', $manufactory->email, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('mobile', trans('admin.mobile')) !!}
                {!! Form::text('mobile', $manufactory->mobile, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('address', trans('admin.address')) !!}
                {!! Form::text('address', $manufactory->address, ['class'=>'form-control address']) !!}
            </div>
            <div class="form-group">
                <div id="us1" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="form-group">
                {!! Form::label('facebook', trans('admin.facebook')) !!}
                {!! Form::text('facebook', $manufactory->facebook, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('twitter', trans('admin.twitter')) !!}
                {!! Form::text('twitter', $manufactory->twitter, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {{ Form::label('icon', trans('admin.manufacturers_icon')) }}
                @if (!empty($manufactory->icon))
                    <img class="rounded m-2" src="{{Storage::url($manufactory->icon)}}" width="150" height="100" alt="Icon image" />
                @endif
                <div class="custom-file">
                    {{ Form::file('icon', ['id' => 'customFile', 'class' => 'custom-file-input']) }}
                    {{ Form::label('customFile', trans('admin.manufacturers_icon'), ['class' => 'custom-file-label']) }}
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
