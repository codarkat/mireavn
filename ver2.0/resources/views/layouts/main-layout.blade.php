<!DOCTYPE html>
<html lang="en">

    @include('partials-main.head')
    <!-- Body-->
    <body style="font-family: 'Quicksand', sans-serif !important;">

<main class="page-wrapper">

    @include('partials-main.navbar')
    @yield('content')
    @include('partials-main.modal')
</main>

    @include('partials-main.footer')
    @include('partials-main.back-to-top')
    @include('partials-main.script')

</body>
</html>
