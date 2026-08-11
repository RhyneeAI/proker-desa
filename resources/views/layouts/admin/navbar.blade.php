<header class="navbar navbar-expand-lg border-bottom d-print-none">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="d-none d-lg-block">
            <h1 class="page-title mb-0 fs-3 fw-semibold">{{ $title }}</h1>
        </div>

        <div class="navbar-nav flex-row order-md-last ms-auto">
            <div class="nav-item d-flex align-items-center me-2"
                x-data="{ dark: document.documentElement.getAttribute('data-bs-theme') === 'dark' }">
                <button type="button" class="btn btn-icon"
                    @click="dark = !dark; document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light'); localStorage.setItem('theme', dark ? 'dark' : 'light')"
                    :aria-label="dark ? 'Mode terang' : 'Mode gelap'">
                    <i class="ti" :class="dark ? 'ti-sun' : 'ti-moon'"></i>
                </button>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="avatar avatar-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    <div class="d-none d-xl-block ps-2">
                        <div class="fw-semibold">{{ auth()->user()->name }}</div>
                        <div class="mt-1 small text-secondary">Administrator</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('admin.profile') }}" class="dropdown-item">
                        <i class="ti ti-user me-2 text-secondary"></i>
                        Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="ti ti-logout me-2 text-secondary"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
