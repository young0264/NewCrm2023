@yield('head', View::make('layouts.html'))

<body>
@guest
    @yield('content')
@else
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @yield('menu', View::make('layouts.menu'))
        @yield('content')
        @yield('bottom', View::make('layouts.bottom'))
    </div>
</div>
@endguest
</body>
</html>
