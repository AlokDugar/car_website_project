<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu">
                    <a href="#"><i class="la la-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{Request::routeIs('dashboard_users.index')?'active':''}}" href="{{url('/dashboard_users')}}">Users</a></li>
                        <li><a class="{{Request::routeIs('dashboard_cars.index')?'active':''}}" href="{{url('/dashboard_cars')}}">Cars</a></li>
                        <li><a class="{{Request::routeIs('dashboard_models.index')?'active':''}}" href="{{url('/dashboard_models')}}">Models</a></li>

                    </ul>
                </li>

                </li>
            </ul>
        </div>
    </div>
</div>
