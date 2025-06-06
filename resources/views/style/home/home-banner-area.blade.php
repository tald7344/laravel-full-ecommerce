
@if ($homeBanners->isNotEmpty())
  <div class="home-banner {{ $homeBanners->count() > 1 ? 'active-banner-slider owl-carousel' : '' }}" style="direction: {{ $ltr }}">
    @foreach($homeBanners as $banner)
    <!-- start banner Area -->
      <section class="banner-area" style="background: url('{{Storage::url($banner->image)}}') center no-repeat;background-size: cover;">
        <div class="container">
          <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
              <div class="" style="direction: {{ $ltr }}">
                <!-- single-slide -->
                <div class="row single-slide align-items-center d-flex">
                  <div class="col-12">
                    <div class="banner-content">
                      <h1>{{ $banner->{'title_' . lang()} }}</h1>
                      <p>{{ $banner->{'content_' . lang()} }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endforeach
  </div>
@endif
