
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="/">Home</a>
        <a class="sidebar-brand brand-logo-mini" href="/">Home</a>
    </div>
    <div class="sidebar-menu-wrapper">
        <ul class="nav">

            <li class="nav-item nav-category">
                <span class="nav-link">Navigation</span>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('users')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Users</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('food_admin_menu')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-playlist-play"></i>
                    </span>
                    <span class="menu-title">Food Menu</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('chefs')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-table-large"></i>
                    </span>
                    <span class="menu-title">Chefs</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('view_reservations')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-chart-bar"></i>
                    </span>
                    <span class="menu-title">Reservations</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('orders')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-chart-bar"></i>
                    </span>
                    <span class="menu-title">Orders</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
