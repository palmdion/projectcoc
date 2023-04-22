<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="sidebaradmin" >
    <br><br><br>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link active" href="{{ url('/dashboard') }}">
            <span>แดชบอร์ด</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('users.index') }}">
            <span>จัดการข้อมูลผู้ใช้งาน</span></a>
    </li>
    <!--
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('education.index') }}">
            <span>Education Users</span></a>
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('work.index') }}">
            <span>Work Users</span></a>
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="{{-- route('province.index') --}}">
            <span>Provinces</span></a>
    </li>
-->


    <!-- Divider -->
    <hr class="sidebar-divider">

    {{--@hasrole('Admin')
        <!-- Heading

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item ">
            <a class="nav-link" href="{{ route('roles.index') }}">
                <span>บทบาทของผู้ใช้</span></a>
            <!--<a class="nav-link" href="{{ route('permissions.index') }}">
                <span>Permissions</span></a>-->
        </li>
        <!-- Divider
        <hr class="sidebar-divider d-none d-md-block">
    @endhasrole
        --}}

       <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('event.index') }}">
            <span>จัดการข้อมูลกิจกรรม</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

       <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('posts.indexPost') }}">
            <span>จัดการข้อมูลข่าวสาร</span></a>
    </li>

       <!-- Nav Item - Pages Collapse Menu -->
    <!--<li class="nav-item ">
        <a class="nav-link" href="{{ route('category.index') }}">
            <span>Category</span></a>
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('tag.index') }}">
            <span>Tags</span></a>
    </li>-->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item ">
        <a class="nav-link" href="{{ route('mail.indexSendMail') }}">
            <span>ส่งเมลให้ผู้ใช้งาน</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
    onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
     {{ __('ออกจากระบบ') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>

