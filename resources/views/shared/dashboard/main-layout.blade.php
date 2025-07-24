<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title','Dashboard ')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
     @include('shared.dashboard.header-refrences')
     @yield('header-styles')
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">

        @include('shared.dashboard.header')

        <!-- Sidebar Start -->
        @include('shared.dashboard.sidebar')
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('shared.dashboard.navbar')
            <!-- Navbar End -->

            <div class="container-fluid pt-4 px-4">
               @yield('content')
            </div>
         


            <!-- Footer Start -->
            @include('shared.dashboard.footer')
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    @include('shared.dashboard.footer-refrences')
    @yield('footer-scripts')
</body>

</html>