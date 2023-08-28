{{--<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'COC Alumni') }} | @yield('title')</title>

    <!-- Font Awesome UI KIT-->
    {{--<script src="https://kit.fontawesome.com/f75ab26951.js" crossorigin="anonymous"></script>--}}

    {{--<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">--}}


     {{--<!-- Custom styles for this template-->
     <link href="{{asset('.../css/app.css')}}" rel="stylesheet">
     <link href="{{asset('.../admin/css/sb-admin-2.min.css')}}" rel="stylesheet">


    <script src=".../bootstrap.min.js"></script>

    <!-- App core JavaScript-->
    <script src="{{asset('js/app.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

     <!-- Custom styles for this template-->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href=".../bootstrap.min.css">

    <!-- js -->
    <script src="{{asset('.../mainjs.bootstrap.min.js')}}"></script>

</head>--}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ('COC Alumni Admin') }} | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('admin/image/iconLogo.png') }}" type="image/x-icon">

    <!--<script src="{{ asset('admin1/js/bootstrap.min.js') }}"></script>-->

    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href='{{ asset('admin/css/admin.css') }}'>
    <link rel="stylesheet" href="{{asset('common/css/common.css')}}">

     <!-- Scripts -->
    {{--@vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}

     @vite(['resources/js/app.js'])

     <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .description-cell {
    max-width: 150
    }
</style>

</head>

