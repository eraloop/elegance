<div class="admin-header">
    <div class="d-flex align-items-center">
        <button id="sidebarToggle" class="btn btn-link d-lg-none mr-3">
            <i class="fas fa-bars"></i>
        </button>
        <h4 class="mb-0 font-weight-bold text-dark">
            @yield('title', 'Dashboard')
        </h4>
    </div>

    <div class="d-flex align-items-center">
        <div class="dropdown">
            <button class="btn btn-link text-dark dropdown-toggle text-decoration-none" type="button" id="userDropdown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ auth()->guard('admin')->user()->name }}&background=084734&color=fff"
                    alt="User" class="rounded-circle mr-2" width="35" height="35">
                <span class="font-weight-600">{{ auth()->guard('admin')->user()->name }}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>