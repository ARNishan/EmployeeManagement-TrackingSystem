<ul id="slide-out" class="sidenav sidenav-fixed grey lighten-4">
    <li>
        <div class="user-view">
            <div class="background">
            </div>
            {{-- Get picture of  authenicated user --}}
            <a href="{{route('user.auth.show')}}"><img class="circle" src="{{asset(Auth::user()->picture)}}"></a>
            {{-- Get first and last name of authenicated user --}}
            <a href="{{route('user.auth.show')}}"><span class="white-text name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></a>
            {{-- Get email of authenicated user --}}
            <a href="{{route('user.auth.show')}}"><span class="white-text email">{{ Auth::user()->email }}</span></a>
        </div>
    </li>
    <li>
        <a class="waves-effect waves-grey" href="{{route('user.dashboard')}}"><i class="material-icons">dashboard</i>Dashboard</a>
    </li>
    <li>
        <a class="waves-effect waves-grey" href="{{route('user.messenger')}}"><i class="material-icons">chat_bubble</i>Messenger</a>
    </li>
    {{-- <li>
        <a class="waves-effect waves-grey" href="{{route('employees')}}"><i class="material-icons">supervisor_account</i>Employee Management</a>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header"><i class="material-icons pl-15">settings</i><span class="pl-15">System Management</span></a>
                <div class="collapsible-body">
                    <ul>
                        <li>
                            <a href="{{route('departments')}}" class="waves-effect waves-grey">
                                <i class="material-icons">business</i>
                                Department
                            </a>
                        </li>
                        <li>
                            <a href="{{route('salaries')}}" class="waves-effect waves-grey">
                                <i class="material-icons">attach_money</i>
                                Salary
                            </a>
                        </li>
                        <li>
                            <a href="{{route('divisions')}}" class="waves-effect waves-grey">
                            <i class="material-icons">business</i>
                                Division
                            </a>
                        </li>
                        <li>
                            <a href="{{route('cities')}}" class="waves-effect waves-grey">
                            <i class="material-icons">location_city</i>
                                City
                            </a>
                        </li>
                        <li>
                            <a href="{{route('states')}}" class="waves-effect waves-grey">
                            <i class="material-icons">grid_on</i>
                                State
                            </a>
                        </li>
                        <li>
                            <a href="{{route('countries')}}" class="waves-effect waves-grey">
                            <i class="material-icons">terrain</i>
                                Country
                            </a>
                        </li>
                        <li>
                            <a href="{{route('reports')}}" class="waves-effect waves-grey">
                                <i class="material-icons">insert_drive_file</i>
                                Report
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{route('admins')}}" class="waves-effect waves-grey"><i class="material-icons">account_circle</i>Admin Management</a>
    </li> --}}
</ul>
