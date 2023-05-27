<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <!-- <img class="app-sidebar__user-avatar" src="{{ auth()->user()->image_path }}" alt="User Image"> -->
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            
        </div>
    </div>

    <ul class="app-menu">

        <li><a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-home"></i> <span class="app-menu__label">Home</span></a></li>
        
        <li><a class="app-menu__item {{ request()->is('*users*') ? 'active' : '' }}" href="{{ route('users.index') }}"><i class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">Users</span></a></li>

        <li><a class="app-menu__item {{ request()->is('*genres*') ? 'active' : '' }}" href="{{ route('genres.index') }}"><i class="app-menu__icon fa fa-list"></i> <span class="app-menu__label">Genres</span></a></li>
        
        <li><a class="app-menu__item {{ request()->is('*movies*') ? 'active' : '' }}" href="{{ route('movies.index') }}"><i class="app-menu__icon fa fa-film"></i> <span class="app-menu__label">Movies</span></a></li>
        
        <li><a class="app-menu__item {{ request()->is('*actors*') ? 'active' : '' }}" href="{{ route('actores.index') }}"><i class="app-menu__icon fa fa-address-book-o"></i> <span class="app-menu__label">Actores</span></a></li>
        
        <li class="treeview {{ request()->is('*settings*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i>Settings</a></li>
            </ul>
        </li>
        
        <li class="treeview {{ request()->is('*profile*') || request()->is('*password*')  ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-circle"></i><span class="app-menu__label">Profile</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i>Edit Profile</a></li>
                <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i>Change Password</a></li>
            </ul>
        </li>

    </ul>
</aside>
