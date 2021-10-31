<!DOCTYPE html>
<html lang="en">

    @include('partials-admin.head')
    <body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            @include('partials-admin.header')
            @yield('content')

            @include('partials-admin.footer')
        </div>
    </div>
    @include('partials-admin.script')
    </body>
</html>
