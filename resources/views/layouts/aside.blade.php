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

        <li><a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="app-menu__icon fa fa-home"></i> <span class="app-menu__label">Home</span></a></li>
        
        <li><a class="app-menu__item {{ request()->is('*genres*') ? 'active' : '' }}" href="{{ route('genres.index') }}"><i class="app-menu__icon fa fa-list"></i> <span class="app-menu__label">Genres</span></a></li>
        
    </ul>
</aside>
