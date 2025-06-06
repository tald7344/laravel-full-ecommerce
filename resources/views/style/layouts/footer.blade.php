@php
  $menu = \App\Model\Menu::find(1);
@endphp
<!-- start footer Area -->
<footer class="footer-area pb-3">
  <div class="container">
    <div class="row">
      @if (!is_null($menu) && $menu->links->isNotEmpty())
        @foreach($menu->links as $link)
          @if ($link->hasLink == 0)
            <div class="col-12 col-md mx-auto text-center">
              <div class="single-footer-widget">
                <h6>{{$link->{'link_name_' . lang()} }}</h6>
                {!! $link->{'link_content_' . lang()} !!}
                @if ($link->sons->isNotEmpty())
                  @if ($link->id == 2)
                    <div class="footer-social align-items-center mx-auto">
                      @foreach($link->sons as $son)
                        @if ($son->hasLink == 1)
                          <a class="px-2" href="{{is_null($son->url) ? '#' : $son->url}}" title="{{$son->{'link_name_' . lang()} }}">{!! $son->{'link_content_' . lang()} !!}</a>
                        @endif
                      @endforeach
                    </div>
                  @else
{{--                    <div class="footer-social d-flex align-items-center">--}}
                      <ul class="list-unstyled">
                        @foreach($link->sons as $son)
                          @if ($son->hasLink == 1)
                            <li>
                              <a class="text-white" href="{{is_null($son->url) ? '#' : $son->url}}" title="{{$son->{'link_name_' . lang()} }}">{!! $son->{'link_name_' . lang()} !!}</a>
                            </li>
                          @endif
                        @endforeach
                      </ul>
{{--                    </div>--}}
                  @endif
                @endif
              </div>
            </div>
          @else
            <div class="col-lg-4 col-sm-6 mx-auto">
              <div class="single-footer-widget">
                <h6><a href="{{is_null($link->url) ? '#' : $link->url}}" title="{{$link->{'link_name_' . lang()} }}">{!! $link->{'link_content_' . lang()} !!}</a></h6>
              </div>
            </div>
          @endif
        @endforeach
      @endif
{{--      <div class="col-lg-4 col-sm-6 mx-auto">--}}
{{--        <div class="single-footer-widget">--}}
{{--          <h6>Newsletter</h6>--}}
{{--          <p>Stay update with our latest</p>--}}
{{--          <div class="" id="mc_embed_signup">--}}

{{--            <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"--}}
{{--                  method="get" class="form-inline">--}}

{{--              <div class="d-flex flex-row">--}}

{{--                <input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"--}}
{{--                       required="" type="email">--}}


{{--                <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>--}}
{{--                <div style="position: absolute; left: -5000px;">--}}
{{--                  <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">--}}
{{--                </div>--}}

{{--                <!-- <div class="col-lg-4 col-md-4">--}}
{{--                      <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>--}}
{{--                    </div>  -->--}}
{{--              </div>--}}
{{--              <div class="info"></div>--}}
{{--            </form>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
    </div>
    <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
      <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        @if (lang() == 'en') Copyright @else @endif &copy;<script>document.write(new Date().getFullYear());</script> @lang('admin.all-right-reserved-by') <span class="text-blue">Talal Danoun</span>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
    </div>
  </div>
</footer>
<!-- End footer Area -->
<script>
  var _params = {
    token: '{{ csrf_token() }}'
  }
</script>
<script src="{{asset('design/style/js/vendor/jquery-2.2.4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="{{asset('design/style/js/vendor/bootstrap.min.js')}}"></script>
{{-- ajaxChimp for newsletter --}}
{{--<script src="{{asset('design/style/js/jquery.ajaxchimp.min.js')}}"></script>--}}
<script src="{{asset('design/style/js/jquery.nice-select.min.js')}}"></script>
{{-- sticky to make the navbar sticky --}}
<script src="{{asset('design/style/js/jquery.sticky.js')}}"></script>
{{--<script src="{{asset('design/style/js/nouislider.min.js')}}"></script>--}}
<script src="{{asset('design/style/js/countdown.js')}}"></script>
<script src="{{asset('design/style/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('design/style/js/owl.carousel.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"
        integrity="sha256-yt2kYMy0w8AbtF89WXb2P1rfjcP/HTHLT7097U8Y5b8=" crossorigin="anonymous"></script>

<!--gmaps Js-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
<script src="{{asset('design/style/js/gmaps.min.js')}}"></script>
<script src="{{asset('design/style/js/main.js')}}"></script>
<script src="{{asset('design/style/js/custom.js')}}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</body>

</html>
