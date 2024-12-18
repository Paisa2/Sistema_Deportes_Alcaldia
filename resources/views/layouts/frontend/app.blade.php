<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.frontend.header')
</head>
<body>
    <!-- navigation -->
    @include('layouts.frontend.navigation')

    <!-- content -->

    @yield('content')
    <!-- start footer -->
    @include('layouts.frontend.footer')

    <!-- scripts -->
    @include('layouts.frontend.scripts')
    @yield('scripts')

</body>
</html>