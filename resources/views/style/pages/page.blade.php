@php
  $links = [ ['url' => '#', 'name' => $page->{'name_' . lang()} ] ];
@endphp
@extends('style.index')
@section('content')
  @include('style.layouts.header-image', [ 'imageUrl' => asset('images/about-us-banner.jpg') ])
  @include('style.layouts.breadcrumbs', ['links' => $links, 'title' => $page->{'name_' . lang()}])
  <section class="blog_area single-post-area pb-5">
    <div class="container">
      <div class="row">
        <div class="col-12">
{{--          <h2>{{$page->{'title_' . lang()} }}</h2>--}}
          <div class="content">{!! $page->{'content_' . lang()} !!}</div>
        </div>
      </div>
    </div>
  </section>
@endsection
