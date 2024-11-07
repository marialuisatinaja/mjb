<div class="sidebar-wrapper group">
      <div id="bodyOverlay" class="w-screen h-screen fixed top-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm z-10 hidden"></div>
      <div class="logo-segment" style="background-color: #c4d538;">
        <a class="flex items-center" href="index.html">
          <span class="ltr:ml-3 rtl:mr-3 text-xl font-Inter font-bold text-slate-900 dark:text-white">MJB</span>
        </a>
        <!-- Sidebar Type Button -->
        <div id="sidebar_type" class="cursor-pointer text-slate-900 dark:text-white text-lg">
          <span class="sidebarDotIcon extend-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
        <div class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150 ring-2 ring-inset ring-offset-4 ring-black-900 dark:ring-slate-400 bg-slate-900 dark:bg-slate-400 dark:ring-offset-slate-700"></div>
      </span>
          <span class="sidebarDotIcon collapsed-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
        <div class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150"></div>
      </span>
        </div>
        <button class="sidebarCloseIcon text-2xl">
          <iconify-icon class="text-slate-900 dark:text-slate-200" icon="clarity:window-close-line"></iconify-icon>
        </button>
      </div>
      <div id="nav_shadow" class="nav_shadow h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none
      opacity-0"></div>
      <div style="background-color: #c4d538;" class="sidebar-menus bg-white dark:bg-slate-800 py-2 px-4 h-[calc(100%-80px)] overflow-y-auto z-50" id="sidebar_menus">
        <ul class="sidebar-menu">
          <li class="sidebar-menu-title">MENU</li>
          <li>
            <a href="{{ route('dashboard') }}" class="navItem {{ request()->routeIs('dashboard') ? 'active' : '' }}">
              <span class="flex items-center">
              <iconify-icon class=" nav-icon" icon="heroicons-outline:home"></iconify-icon>
            <span>Dashboard</span>
              </span>
            </a>
          </li>

          @if(Auth::user()->user_type == 'Admin')
          <li>
            <a href="{{ route('reservation.index') }}" class="navItem {{ request()->routeIs('reservation.index') ? 'active' : '' }}">
                <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:clipboard-check"></iconify-icon>
                    <span>Reservation</span>
                </span>
            </a>
        </li>

        <li>
            <a href="{{ route('point.index') }}" class="navItem {{ request()->routeIs('point.index') ? 'active' : '' }}">
                <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:collection"></iconify-icon>
                    <span>Walk In</span>
                </span>
            </a>
        </li>
              <li>
                  <a href="{{ route('service.index') }}" class="navItem {{ request()->routeIs('service.index') ? 'active' : '' }}">
                      <span class="flex items-center">
                          <iconify-icon class="nav-icon" icon="heroicons-outline:view-grid-add"></iconify-icon>
                          <span>Services</span>
                      </span>
                  </a>
              </li>

              <li>
                  <a href="{{ route('package.index') }}" class="navItem {{ request()->routeIs('package.index') ? 'active' : '' }}">
                      <span class="flex items-center">
                          <iconify-icon class="nav-icon" icon="heroicons-outline:view-boards"></iconify-icon>
                          <span>Packages</span>
                      </span>
                  </a>
              </li>

              <li>
                  <a href="{{ route('sale.index') }}" class="navItem {{ request()->routeIs('sale.index') ? 'active' : '' }}">
                      <span class="flex items-center">
                          <iconify-icon class="nav-icon" icon="heroicons-outline:calendar"></iconify-icon>
                          <span>Sales</span>
                      </span>
                  </a>
              </li>

              <li class="">
                  <a href="javascript:void(0)" class="navItem">
                      <span class="flex items-center">
                          <iconify-icon class="nav-icon" icon="heroicons-outline:document"></iconify-icon>
                          <span>User Management</span>
                      </span>
                      <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
                  </a>
                  <ul class="sidebar-submenu">
                      <li>
                          <a href="{{ route('user.index') }}">User</a>
                      </li>
                      <li>
                          <a href="{{ route('certificate.index') }}">Certificate</a>
                      </li>
                  </ul>
              </li>
          @elseif(Auth::user()->user_type == 'Receptionist')
          <li>
            <a href="{{ route('reservation.index') }}" class="navItem {{ request()->routeIs('reservation.index') ? 'active' : '' }}">
                <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:clipboard-check"></iconify-icon>
                    <span>Reservation</span>
                </span>
            </a>
        </li>

        <li>
            <a href="{{ route('point.index') }}" class="navItem {{ request()->routeIs('point.index') ? 'active' : '' }}">
                <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:collection"></iconify-icon>
                    <span>Walk In</span>
                </span>
            </a>
        </li>
              <li>
                  <a href="{{ route('service.index') }}" class="navItem {{ request()->routeIs('service.index') ? 'active' : '' }}">
                      <span class="flex items-center">
                          <iconify-icon class="nav-icon" icon="heroicons-outline:view-grid-add"></iconify-icon>
                          <span>Services</span>
                      </span>
                  </a>
              </li>

              <li>
                  <a href="{{ route('package.index') }}" class="navItem {{ request()->routeIs('package.index') ? 'active' : '' }}">
                      <span class="flex items-center">
                          <iconify-icon class="nav-icon" icon="heroicons-outline:view-boards"></iconify-icon>
                          <span>Packages</span>
                      </span>
                  </a>
              </li>

              <li class="">
                  <a href="javascript:void(0)" class="navItem">
                      <span class="flex items-center">
                          <iconify-icon class="nav-icon" icon="heroicons-outline:document"></iconify-icon>
                          <span>User Management</span>
                      </span>
                      <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
                  </a>
                  <ul class="sidebar-submenu">
                      <li>
                          <a href="{{ route('certificate.index') }}">Certificate</a>
                      </li>
                  </ul>
              </li>
      
          @else
          <li>
              <a href="{{ route('reservation.index') }}" class="navItem {{ request()->routeIs('reservation.index') ? 'active' : '' }}">
                  <span class="flex items-center">
                  <iconify-icon class=" nav-icon" icon="heroicons-outline:clipboard-check"></iconify-icon>
                      <span>Reservation</span>
                  </span>
              </a>
          </li>
          @endif

        </ul>
      </div>
    </div>