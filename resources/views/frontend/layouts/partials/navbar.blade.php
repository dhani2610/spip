<header id="header" class="header d-flex align-items-center fixed-top">
    <div
        class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            {{-- <!-- <img src="assets/img/logo.png" alt=""> --> --}}
            <h1 class="sitename">Teman Move On</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#pricing">Pricing</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @if (Auth::guard('admin')->check() != null)
            <a class="btn-getstarted" href="{{ route('admin.dashboard') }}">Hi, {{ Auth::guard('admin')->user()->name }}</a>
        @else
            <a class="btn-getstarted" href="{{ url('admin/login') }}">Get Started</a>
        @endif

    </div>
</header>
