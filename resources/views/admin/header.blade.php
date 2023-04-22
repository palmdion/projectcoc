
  <nav class="container-fluid navbar bg-body-tertiary " id="headeradmin">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <div class="container-fluid">
      <a class="navbar-brand " href="" >COC Alumni</a>

        <ul class="nav navbar ml-auto">
            <li class="nav-item dropdown">
                <a  class="nav-link dropdown-toggle text-dark-emphasis"
                    href=""
                    data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    <span class=" text-gray-100 mb-0 px-2">{{ Auth::user()->name }}</span>
                    <img class="rounded-circle" width="30px" height="30px" src="{{asset(Auth::user()->user_image)}}" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @hasrole('Admin')
                    <a class=" dropdown-item" href="{{ route('home') }}">
                        {{ __('Home WebSite') }}
                    </a>
                    @endhasrole
                    <a class="dropdown-item" href="{{ route('profile.profileFace') }}">
                        {{ __('Profile') }}
                    </a>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
  </nav>
