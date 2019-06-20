<header>
    <nav class="gradient-bg">
        <div class="container">
            <div class="nav-wrapper">
                <a href="{{route('admin.dashboard')}}" class="brand-logo hide-on-small-only">Employee</a>
                <a href="{{route('admin.dashboard')}}" class="brand-logo show-on-small-only hide-on-med-and-up">EMS</a>
                <ul>
                    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons white-text">menu</i></a>
                </ul>
                <ul class="right">
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="dropdown1">
                            {{ Auth::guard('admin')->user()->username }}
                            <i class="material-icons right white-text">arrow_drop_down</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="{{route('admin.auth.show')}}">Profile</a></li>
  <li class="divider"></li>
  <li><a href="{{ route('admin.logout') }}">Logout</a></li>
</ul>
@include('inc.sidenav')