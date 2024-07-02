<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>@yield('title') | {{ config('app.name') }}</title>

        <meta name="description" content="">
        <meta name="keywords" content="">

        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
              rel="stylesheet">

        <!-- Build asset files -->
        @vite(['resources/scss/internal/app.scss'])
    </head>

    <body>

        <!-- ======= Header ======= -->
        @include('internal.partials.header')
        <!-- End Header -->

        <!-- ======= Sidebar ======= -->
        @include('internal.partials.sidebar')
        <!-- End Sidebar-->

        <!-- ======= Content ======= -->
        <main class="main" id="main">
            <div class="pagetitle">
                <h1>@yield('title')</h1>
                <nav>
                    <ol class="breadcrumb">
                        @hasSection('breadcrumb')
                            @yield('breadcrumb')
                        @else
                            <li class="breadcrumb-item active">@yield('title')</li>
                        @endif
                    </ol>
                </nav>
            </div>

            @yield('content')
        </main>
        <!-- End Content-->

        <!-- ======= Footer ======= -->
        @include('internal.partials.footer')
        <!-- End Footer -->

        <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Build asset file -->
        @vite(['resources/js/internal/app.js'])
    </body>

</html>
