<div class="cont_breadcrumbs d-flex mb-5">
  <div class="cont_breadcrumbs_2">
    <h3>{{ $title }}</h3>
    <ul>
      <li><a href="{{ url('/') }}">{{ trans('admin.home') }}</a></li>
      @if(count($links) > 0)
        @foreach($links as $link)
          <li><a href="{{ $link['url'] }}">{{ $link['name'] }}</a></li>
        @endforeach
      @endif
    </ul>
  </div>
</div>
