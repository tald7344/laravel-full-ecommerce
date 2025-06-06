@if($tradMarks->isNotEmpty())
  <!-- Start brand Area -->
  <section class="brand-area section_gap">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <div class="section-title">
            <h2>@lang('home.brands')</h2>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach($tradMarks as $tradMark)
          <a class="col-6 col-md-4 col-lg-3 col-xl-2 single-img mb-5 mb-md-4">
            <img class="responsive d-block mx-auto" title="{{$tradMark->{'trademarks_name_' . lang()} }}" src="{{Storage::url($tradMark->logo)}}" alt="">
          </a>
        @endforeach
      </div>
    </div>
  </section>
  <!-- End brand Area -->
@endif
