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
            <li class="nav-item {{ active_class(['dashboard']) }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @can('kunjunganTamu-list')
                <li class="nav-item {{ active_class(['user_need.*']) }}">
                    <a href="{{ route('user_need.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Daftar Kunjungan Tamu</span>
                    </a>
                </li>
            @endcan
            @can('tamu-list')
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
            @can('daftar_survey')
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
