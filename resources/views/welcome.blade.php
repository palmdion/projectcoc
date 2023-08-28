<!DOCTYPE html>
<html lang="en">
@include('auth.includes.head')
<body >
    <div class="shadow-sm">
        <div class=" fixed-top">
            <nav class="navbar navbar-expand-md navbar-light bg-white ">
                <ul class="nav container d-flex justify-content-center gap-3" id="headerlow">
                    <!--<li class="nav-item "><a class="nav-link " id="text" href="#">เกี่ยวกับเรา</a></li>-->
                    <li class="nav-item "><a class="nav-link " id="text" href="{{ route('postHome.showAllPost')  }}">ข่าวประชาสัมพันธ์</a></li>
                    <li class="nav-item "><a class="nav-link " id="text" href="{{ route('eventHome.showAllEvent')  }}">กิจกรรม</a></li>
                    @auth
                    <li class="nav-item "><a class="nav-link " id="text" href="{{ route('search.indexSearch')  }}">ค้นหาศิษย์เก่า</a></li>
                    <li class="nav-link"><a class="nav-link " id="text" href="{{ route('sendRequest.indexRequest')  }}">ติดต่อ</a></li>
                    @endauth
                    <!--<li class="nav-item "><a class="nav-link " id="text" href="#" aria-selected="false">ติดต่อเรา</a></li>-->
                </ul>
            </nav>
        </div>
        <br><br><br><br>
        <div >
            <div id="line"></div>
        </div>
        <div class="container bg-dark" height="2px"></div>
        <nav class="navbar navbar-expand-md navbar-light bg-white d-flex ">
            <div class="container ">
                <a class="navbar-brand active" href="{{ route('home') }}">
                    <img src="{{ asset("admin/image/logo1.png") }}" class="" width="190px" height="64px"  alt="...">
                </a>
                <a class="navbar-brand fw-semibold text-black-50  " href="{{ route('home') }}" >COC Alumni</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                                @include('modal-login')

                            @else
                                <li  class="nav-item dropdown">
                                    <a  class="nav-link dropdown-toggle text-dark-emphasis"
                                        href=""
                                        id="author"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" v-pre>
                                        <span class=" text-gray-100 mb-0 px-2">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</span>
                                        {{-- <img class="rounded-circle" width="30px" height="30px" src="{{ asset(Auth::user()->user_image) }}" alt=""> --}}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @hasrole(1)
                                        <a class="dropdown-item" href="{{ url('/dashboard') }}">
                                            {{ __('สำหรับผู้ดูแลระบบ') }}
                                        </a>
                                        @endhasrole
                                        <a class="dropdown-item" href="{{ route('profile.profileFace') }}">
                                            {{ __('โปรไฟล์ผู้ใช้') }}
                                        </a>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                           onclick="event.preventDefault()
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('ออกจากระบบ') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="mt-2">
        @yield('mainContent')
    </div>
    <footer id="footer">
        <div class="container">
            <div>
                &copy;
                Alumni COC
                <span id="copyright">
                    <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
                </span>
            </div>
        </div>
    </footer>
    @include('auth.includes.scripts')
</body>




