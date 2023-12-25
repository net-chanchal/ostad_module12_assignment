<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <li>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route("admin.dashboard.index") }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <h6 class="sidebar-brand-text mx-3 mt-2 font-weight-bold">Ticket Pro</h6>
        </a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs("admin.dashboard.index") ? "active" : "" }}">
        <a class="nav-link" href="{{ route("admin.dashboard.index") }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item {{
    request()->routeIs("admin.buses.index") ||
    request()->routeIs("admin.buses.create") ||
    request()->routeIs("admin.buses.show") ||
    request()->routeIs("admin.buses.edit")
    ? "active" : "" }}">
        <a class="nav-link" href="{{ route("admin.buses.index") }}">
            <i class="fas fa-fw fa-car"></i>
            <span>Buses</span>
        </a>
    </li>

    <li class="nav-item {{
    request()->routeIs("admin.routes.index") ||
    request()->routeIs("admin.routes.create") ||
    request()->routeIs("admin.routes.show") ||
    request()->routeIs("admin.routes.edit")
    ? "active" : "" }}">
        <a class="nav-link" href="{{ route("admin.routes.index") }}">
            <i class="fas fa-fw fa-route"></i>
            <span>Routes</span>
        </a>
    </li>

    <li class="nav-item {{
    request()->routeIs("admin.trips.index") ||
    request()->routeIs("admin.trips.create") ||
    request()->routeIs("admin.trips.show") ||
    request()->routeIs("admin.trips.edit")
    ? "active" : "" }}">
        <a class="nav-link" href="{{ route("admin.trips.index") }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Trips</span>
        </a>
    </li>

    <li class="nav-item {{
    request()->routeIs("admin.tickets.index") ||
    request()->routeIs("admin.tickets.create") ||
    request()->routeIs("admin.tickets.show") ||
    request()->routeIs("admin.tickets.edit")
    ? "active" : "" }}">
        <a class="nav-link" href="{{ route("admin.tickets.create") }}">
            <i class="fas fa-fw fa-ticket-alt"></i>
            <span>Tickets</span>
        </a>
    </li>
</ul>
