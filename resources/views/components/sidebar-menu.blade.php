<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">
                Evolucent
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">
                Evolucent
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Drivers Management</li>
            <li class="dropdown @if ($active_menu=="drivers_management") active @endif">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span> Drivers </span></a>
                <ul class="dropdown-menu">
                    <li class="@if ($active_menu_list=="lists") active @endif">
                        <a href="{{ route('driver_lists') }}" class="nav-link "><i class="fas fa-list"></i> <span> Lists </span></a>
                    </li>
                    <li class="@if ($active_menu_list=="create") active @endif">
                        <a href="{{ route('driver_create') }}" class="nav-link "><i class="fas fa-plus"></i> <span> Create </span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>