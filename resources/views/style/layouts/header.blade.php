<!DOCTYPE html>
<html lang="zxx" class="no-js" dir="{{  direction() }}">
<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="shortcut icon" href="{{ Storage::url(setting()->icon) }}">
  <!-- Author Meta -->
  <meta name="author" content="Talal Danoun">
  <!-- Meta Description -->
  <meta name="description" content="{{ setting()->description }}">
  <!-- Meta Keyword -->
  <meta name="keywords" content="{{ setting()->keywords }}">
  <!-- meta character set -->
  <meta charset="UTF-8">
  <!-- Site Title -->
  <title>{{ setting()->{'sitename_' . lang()} }}</title>
  <!--
    CSS
    ============================================= -->
<style>
  @font-face {
    font-family: 'Avayx Regular';
    src: url('{{ asset('design/style/fonts/Avayx-1yYv.ttf') }}') format('embedded-opentype'), /* Internet Explorer */
    url('{{ asset('design/style/fonts/Avayx-1yYv.ttf') }}') format('woff2'),             /* Super Modern Browsers */
    url('{{ asset('design/style/fonts/Avayx-1yYv.ttf') }}') format('woff'),              /* Pretty Modern Browsers */
    url('{{ asset('design/style/fonts/Avayx-1yYv.ttf') }}') format('truetype'),          /* Safari, Android, iOS */
    url('{{ asset('design/style/fonts/Avayx-1yYv.ttf') }}') format('svg');               /* Legacy iOS */
  }
</style>

  <link rel="stylesheet" href="{{asset('design/style/css/linearicons.css')}}">
  <link rel="stylesheet" href="{{asset('design/style/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('design/style/css/themify-icons.css')}}">
  @if (lang() == 'en')
    <link rel="stylesheet" href="{{asset('design/style/css/bootstrap.css')}}">
  @else
    <link rel="stylesheet" href="{{asset('design/style/css/bootstrap.rtl.min.css')}}">
  @endif
  <link rel="stylesheet" href="{{asset('design/style/css/owl.carousel.css')}}">
  <link rel="stylesheet" href="{{asset('design/style/css/nice-select.css')}}">
{{--  <link rel="stylesheet" href="{{asset('design/style/css/nouislider.min.css')}}">--}}
{{--  <link rel="stylesheet" href="{{asset('design/style/css/ion.rangeSlider.css')}}" />--}}
{{--  <link rel="stylesheet" href="{{asset('design/style/css/ion.rangeSlider.skinFlat.css')}}" />--}}
  <link rel="stylesheet" href="{{asset('design/style/css/magnific-popup.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <link rel="stylesheet" href="{{asset('design/style/css/custom/loader.css')}}">
  <link rel="stylesheet" href="{{asset('design/style/css/custom/main.css')}}">
  @if (lang() == 'ar')
    <link rel="stylesheet" href="{{asset('design/style/css/custom/main-rtl.css')}}">
  @endif
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="@yield('page-style')">
</head>
<body>
