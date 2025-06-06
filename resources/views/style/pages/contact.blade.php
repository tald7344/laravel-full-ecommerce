@php
  $page = \App\Model\Page::where('slug', 'contact-us')->first();
  $links = [ ['url' => '#', 'name' => trans('admin.contact')] ];
@endphp
@extends('style.index')
@section('content')
  @include('style.layouts.header-image', [ 'imageUrl' => asset('images/bg-contact.jpg') ])
  @include('style.layouts.breadcrumbs', ['links' => $links, 'title' => trans('admin.contact-page')])
  <!--================Contact Area =================-->
  <section class="contact_area section_gap_bottom">
    <div class="container">
      <div id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
           data-mlat="40.701083" data-mlon="-74.1522848">
      </div>
      <div class="row">
        @if (!is_null($page))
          <div class="col-md-5 col-lg-3">
            <div class="contact_info">
              {!! $page->{'content_' . lang()} !!}
            </div>
          </div>
        @endif
        <div class="{{!is_null($page) ? 'col-md-7 col-lg-9' : 'col-12'}}">
          {!! Form::open(['method' => 'POST', 'class' => 'row contact_form', 'id' => 'contactForm', 'novalidate' => 'novalidate']) !!}
              <div class="col-md-6">
                <div class="form-group">
                  {{ Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => trans('auth.name'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.name') . '"' ]) }}
                </div>
                <div class="form-group">
                  {{ Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => trans('auth.email'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.email') . '"' ]) }}
                </div>
                <div class="form-group">
                  {{ Form::text('subject', old('subject'), ['class' => 'form-control', 'id' => 'subject', 'placeholder' => trans('auth.enter-subject'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.enter-subject') . '"' ]) }}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {{ Form::textarea('message', old('message'), ['class' => 'form-control', 'rows' => '1', 'id' => 'message', 'placeholder' => trans('auth.enter-message'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('auth.enter-message') . '"' ]) }}
                </div>
              </div>
              <div class="col-md-12 text-right">
                <button type="submit" value="submit" class="primary-btn contact-button">{{trans('product.send')}}</button>
              </div>
          {!! Form::close() !!}
          <div class="error-result d-none text-center alert alert-danger mt-3"></div>
        </div>
      </div>
    </div>
  </section>

@endsection

@push('js')
  <script>
    $('#contactForm').submit(function (e) {
      e.preventDefault();
      let form = $(this)[0];
      let formData = new FormData(form);
      $.ajax({
        url: '{{ route('contact.send') }}',
        type: 'POST',
        contentType: false,
        processData: false,
        data: formData,
        beforeSend: function () {
          $('.contact-button').css({'pointer-events': 'none', 'opacity': '.7'});
        },
        error: function (response) {
          console.log('error : ' , response);
          $('.contact-button').css({'pointer-events': 'auto', 'opacity': '1'});
        },
        success: function (response) {
          $('.contact-button').css({'pointer-events': 'auto', 'opacity': '1'});
          if (response.error) {
            $('.error-result').removeClass('d-none').html(response.result);
            setTimeout(() => {
              $('.error-result').html('').addClass('d-none');
            }, 5000);
          } else {
            form.reset();
            // Add success message
            $('#custom-message').addClass('show');
            $('#custom-message .message-text').html(response.result);
          }
        }
      });
    });
  </script>
@endpush
