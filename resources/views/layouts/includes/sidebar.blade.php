<div id="sidebar" class="app-sidebar">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-search mb-n3">
                <input type="text" class="form-control" placeholder="Sidebar menu filter..." data-sidebar-search="true">
            </div>

            <div class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }} mt-2">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-dashboard"></i>
                    </div>
                    <div class="menu-text">Dashboard</div>
                </a>
            </div>
            <div class="menu-header">Promotion Management</div>
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
                    <div
                        class="menu-item {{ request()->routeIs('category.index', 'category.create', 'category.show', 'category.edit') ? 'active' : '' }}">
                        <a href="{{ route('category.index') }}" class="menu-link">
                            <div class="menu-text">Category</div>
                        </a>
                    </div>
                    <div
                        class="menu-item {{ request()->routeIs('subcategory.index', 'subcategory.create', 'subcategory.show', 'subcategory.edit') ? 'active' : '' }}">
                        <a href="{{ route('subcategory.index') }}" class="menu-link">
                            <div class="menu-text">Sub Category</div>
                        </a>
                    </div>


                </div>

                <div class="menu-item {{ request()->routeIs('banner.index', 'banner.create', 'banner.edit') ? 'active' : '' }}">

                    <a href="{{ route('banner.index') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-dashboard"></i>
                        </div>
                        <div class="menu-text">Banner</div>
                    </a>
                </div>

                <div class="menu-item {{ request()->routeIs('logo.index', 'logo.create', 'logo.edit') ? 'active' : '' }}">

                    <a href="{{ route('logo.index') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-dashboard"></i>
                        </div>
                        <div class="menu-text">Logo</div>
                    </a>
                </div>
            </div>

        </div>

        <!-- BEGIN minify-button -->
        {{-- <div class="menu-item d-flex">
            <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i
                    class="fa fa-angle-double-left"></i></a>
        </div> --}}
        <!-- END minify-button -->
    </div>
    <!-- END scrollbar -->
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a>
</div>
