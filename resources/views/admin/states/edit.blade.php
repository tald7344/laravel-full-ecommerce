@extends('admin.index')
@section('content')
@push('js')
<script>
    $(document).ready(function () {
        @if ($state->country_id)
            $.ajax({
                url: '{{ aurl("state/create") }}',
                type: 'GET',
                dataType: 'html',
                data: {
                    country_id: {{ $state->country_id }},
                    select:  {{ $state->city_id }}
                },
                success: function (response) {
                    $('.city_id_span').html(response);
                }
            });
        @else
            $(document).on('change', '.country_id_class', function () {
                var country_id = $('.country_id_class option:selected').val()
                if (country_id > 0) {
                    $.ajax({
                        url: '{{ aurl("state/create") }}',
                        type: 'GET',
                        dataType: 'html',
                        data: {
                            country_id: country_id,
                            select: ''
                        },
                        success: function (response) {
                            $('.city_id_span').html(response);
                        }
                    });
                } else {
                    $('.city_id_span').html('');
                }
            });
        @endif
    });
</script>
@endpush



<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => ['state.update', $state->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('states_name_ar', trans('admin.states_name_ar')) }}
            {{ Form::text('states_name_ar', $state->states_name_ar, ['class' => 'form-control'] )}}
        </div>
        <div class="form-group">
            {{ Form::label('states_name_en', trans('admin.states_name_en')) }}
            {{ Form::text('states_name_en', $state->states_name_en, ['class' => 'form-control'] )}}
        </div>
        <div class="form-group">
            {{ Form::label('country_id', trans('admin.country_id')) }}
            {{ Form::select('country_id', \App\Model\Country::pluck('countries_name_'  . session('lang'), 'id'), $state->country_id, ['class' => 'form-control'] )}}
        </div>
        <div class="form-group">
            {{ Form::label('city_id', trans('admin.city_id')) }}
            <span class='city_id_span'></span>
        </div>

            {{ Form::hidden('_method', 'PUT') }}
            {{ Form::submit(trans('admin.save'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
