<div id="sidebar" class="app-sidebar">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-profile">
                <a class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-cover with-shadow"></div>
                    <div class="menu-profile-image">
                        @if (Auth::user()->image)
                            <img src="{{ asset('') }}{{ Auth::user()->image ?? '' }}"
                                alt="{{ asset('assets/img/person-dummy-e1553259379744.jpg') }}" />
                        @else
                            <img src="{{ asset('assets/img/person-dummy-e1553259379744.jpg') }}" alt="" />
                        @endif
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="menu-header">Navigation</div>
            <div class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-dashboard"></i>
                    </div>
                    <div class="menu-text">Dashboard</div>
                </a>
            </div>

            {{-- <div class="menu-item {{ request()->routeIs('category.index') ? 'active' : '' }}">
                <a href="{{ route('category.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-dashboard"></i>
                    </div>
                    <div class="menu-text">Categories</div>
                </a>
            </div> --}}


            <div
            class="menu-item has-sub {{ request()->routeIs('subcategory.index', 'subcategory.create', 'subcategory.edit') ? 'active' : '' }}{{ request()->routeIs('category.index', 'category.create', 'category.show', 'category.edit') ? 'active' : '' }} ">
            <a href="javascript:;" class="menu-link">
                <div class="menu-icon">
                    <i class="fas fa-tablet-screen-button"></i>
                </div>
                <div class="menu-text">Categories</div>
                <div class="menu-caret"></div>
            </a>
            <div class="menu-submenu">
                {{-- @if (isset($user_data) &&
                        isset($permissions) &&
                        (in_array('subcategory_create', $permissions) ||
                            in_array('subcategory_edit', $permissions) ||
                            in_array('subcategory_list', $permissions) ||
                            in_array('subcategory_delete', $permissions) ||
                            in_array('subcategory_show', $permissions))) --}}
                    <div
                        class="menu-item {{ request()->routeIs('category.index', 'category.create', 'category.show', 'category.edit') ? 'active' : '' }}">
                        <a href="{{ route('category.index') }}" class="menu-link">
                            <div class="menu-text">Category</div>
                        </a>
                    </div>
                {{-- @endif --}}
                <div
                    class="menu-item {{ request()->routeIs('subcategory.index', 'subcategory.create', 'subcategory.show', 'subcategory.edit') ? 'active' : '' }}">
                    <a href="{{ route('subcategory.index') }}" class="menu-link">
                        <div class="menu-text">Sub Category</div>
                    </a>
                </div>
            </div>
        </div>

        </div>

        <!-- BEGIN minify-button -->
        <div class="menu-item d-flex">
            <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i
                    class="fa fa-angle-double-left"></i></a>
        </div>
        <!-- END minify-button -->
    </div>
    <!-- END scrollbar -->
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a>
</div>
