<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            SITAMU
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class(['/']) }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @can('kunjungan_tamu')
                <li class="nav-item {{ active_class(['user_need.*']) }}">
                    <a href="{{ route('user_need.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Daftar Kunjungan Tamu</span>
                    </a>
                </li>
            @endcan
            @can('daftar_tamu')
                <li class="nav-item {{ active_class(['user_detail.*']) }}">
                    <a href="{{ route('user_detail.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Daftar Tamu</span>
                    </a>
                </li>
            @endcan
            @can('daftar_admin')
                <li class="nav-item {{ active_class(['user.*']) }}">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Daftar Admin</span>
                    </a>
                </li>
            @endcan
            @can('daftar_cctv')
                <li class="nav-item {{ active_class(['cctv.*']) }}">
                    <a href="{{ route('cctv.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Daftar CCTV</span>
                    </a>
                </li>
            @endcan
            @can('daftar_cctv')
                <li class="nav-item {{ active_class(['surveyQuestion.*']) }}">
                    <a href="{{ route('surveyQuestion.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Daftar Survey</span>
                    </a>
                </li>
            @endcan
            @can('daftar_role')
                <li class="nav-item {{ active_class(['role.*']) }}">
                    <a href="{{ route('role.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Daftar Role</span>
                    </a>
                </li>
            @endcan
            @can('daftar_permission')
                <li class="nav-item {{ active_class(['permission.*']) }}">
                    <a href="{{ route('permission.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Daftar Permission</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted mb-2">Sidebar:</h6>
        <div class="mb-3 pb-3 border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                        value="sidebar-light" checked>
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                        value="sidebar-dark">
                    Dark
                </label>
            </div>
        </div>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Version:</h6>
            <a class="theme-item active" href="https://www.nobleui.com/laravel/template/demo1/">
                <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
            </a>
            <h6 class="text-muted mb-2">Dark Version:</h6>
            <a class="theme-item" href="https://www.nobleui.com/laravel/template/demo2/">
                <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
            </a>
        </div>
    </div>
</nav>
