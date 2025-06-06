@include('style.layouts.header')
@include('style.layouts.navbar')
{{--@include('style.layouts.menu')--}}
@include('style.layouts.model')
{{--@include('style.layouts.messages')--}}

@yield('content')
@include('style.layouts.loader', ['slug' => 'home'])
@include('style.layouts.footer')
