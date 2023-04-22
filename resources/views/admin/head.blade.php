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
    <link rel="shortcut icon" href="{{ asset('admin1/image/iconLogo.png') }}" type="image/x-icon">

    <!--<script src="{{ asset('admin1/js/bootstrap.min.js') }}"></script>-->

    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href='{{ asset('admin/css/admin.css') }}'>
    <link rel="stylesheet" href="{{asset('common/css/common.css')}}">

     <!-- Scripts -->
    {{--@vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}

     @vite(['resources/js/app.js'])


</head>

