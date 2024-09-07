<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- Custom fonts for this template-->
    <link href="{{asset("theme/vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link rel="shortcut icon" href="{{asset('Assets/Images/book-store.svg')}}" type="image/svg+xml">
    @vite('resources/scss/sb-admin-2.scss')
    @yield('head','')
</head>

<body id="page-top" style="font-family: Cairo,serif;">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('dashboard.layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('dashboard.layouts.header')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                </div>
                @if(session()->has('success'))
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-12">
                            <div class="alert alert-success text-center" role="alert">
                                {{session()->get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                @endif
                @yield('content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('theme/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('theme/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('theme/js/sb-admin-2.min.js')}}"></script>
@yield('script','')
</body>

</html>
