<!DOCTYPE html>
<html lang="en">

@include('admin.head')

{{--<body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            @include('admin.sidebar')
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    @include('admin.header')
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    @yield('content')
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        @include('admin.logout-modal')


        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('.../js/app.js')}}"></script>

        <script src="{{'.../bootstrap.min.js'}}"></script>

        <script src="{{asset('/bootstrap.min.js')}}"></script>

         <!-- Custom scripts for all pages-->
        <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

        <script src="{{asset('resources/mainjs.bootstrap.min.js')}}"></script>


        @yield('scripts')
</body>--}}

<body id="app">
    <div class="container-fluid m-0 p-0">

       <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.sidebar')
        <!-- End of Sidebar -->

         <!-- Main Content -->
         <div id="content-wrapper" class="d-flex flex-column">

             <div id="content">
                    <!-- Topbar -->
                @include('admin.header')
                <!-- End of Topbar -->

                    <main class="pt-2">
                        <!-- Begin Page Content -->
                        @yield('content')
                    <!-- /.container-fluid -->
                    </main>
             </div>

         </div>
         <!-- End of Main Content -->
       </div>
    </div>
</body>
</html>
