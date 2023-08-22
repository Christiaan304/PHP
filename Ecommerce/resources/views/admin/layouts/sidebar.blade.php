@auth
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}">{{ __('Admin') }}</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="{{ route('admin.dashboard') }}">{{ __('Admin') }}</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">{{ __('Dashboard') }}</li>

                <li class="dropdown active">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                            class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>

                <li class="menu-header">{{ __('Starter') }}</li>

                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                        <span>{{ __('Manage Categories') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('admin.category.index') }}">{{ __('Category') }}</a></li>
                        <li><a class="nav-link" href="{{ route('admin.subcategory.index') }}">{{ __('Subcategory') }}</a>
                        <li><a class="nav-link" href="{{ route('admin.childcategory.index') }}">{{ __('Childcategory') }}</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                        <span>{{ __('Manage Website') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('admin.slider.index') }}">{{ __('Slider') }}</a></li>
                        <li><a class="nav-link" href="{{ route('admin.category.index') }}">{{ __('Category') }}</a></li>
                        <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                    </ul>
                </li>

                {{-- <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                        <span>Layout</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                        <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                        <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                    </ul>
                </li> --}}
                {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>BlankPage</span></a> --}}
            </ul>
        </aside>
    </div>
@endauth
