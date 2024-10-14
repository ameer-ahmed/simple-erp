<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route(session('guard').'.auth.logout') }}">
                <i class="fas fa-arrow-circle-right"></i>
                <span>{{ __('dashboard.Logout') }}</span>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
