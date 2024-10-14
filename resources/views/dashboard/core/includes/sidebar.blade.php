<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route(session('guard').'./') }}" class="brand-link">
        {{--        <img src="{{asset("logo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">@lang('dashboard.Simple ERP')</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img
                    src="{{ auth(session('guard'))->user()->image? asset(auth(session('guard'))->user()->image) :asset('img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth(session('guard'))->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item  {{ in_array(request()->route()->getName(),['manager./', 'employee./'])? 'menu-open': '' }}">
                    <a href="{{ route(session('guard').'./') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.Home')
                        </p>
                    </a>
                </li>

                @if(session('guard') == 'manager' && !auth('manager')->user()->is_stakeholder)
                    <li class="nav-item  {{ in_array(request()->route()->getName(),['manager.employees.index', 'manager.employees.create', 'manager.employees.edit'])? 'menu-open': '' }}">
                        <a href="{{ route('manager.employees.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.Employees')
                            </p>
                        </a>
                    </li>

                    <li class="nav-item  {{ in_array(request()->route()->getName(),['manager.tasks.index', 'manager.tasks.create', 'manager.tasks.edit'])? 'menu-open': '' }}">
                        <a href="{{ route('manager.tasks.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.Tasks')
                            </p>
                        </a>
                    </li>
                @endif

                @if(session('guard') == 'manager' && auth('manager')->user()->is_stakeholder)
                    <li class="nav-item  {{ in_array(request()->route()->getName(),['manager.departments.index', 'manager.departments.create', 'manager.departments.edit'])? 'menu-open': '' }}">
                        <a href="{{ route('manager.departments.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.Departments')
                            </p>
                        </a>
                    </li>
                @endif

                @if(session('guard') == 'employee')
                    <li class="nav-item  {{ in_array(request()->route()->getName(),['employee.tasks.index'])? 'menu-open': '' }}">
                        <a href="{{ route('employee.tasks.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.Tasks')
                            </p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
