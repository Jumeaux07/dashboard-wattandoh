@include('themes.layouts.head')
<!-- Start Leftbar -->
@include('themes.layouts.sidebar')
<!-- End Leftbar -->
<!-- Start Rightbar -->
<div class="rightbar">
    @include('themes.layouts.header')
    @yield('content')
@include('themes.layouts.footer')
