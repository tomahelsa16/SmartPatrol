        <!DOCTYPE html>
        <html lang="id">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>@yield('title', 'Smart Patrol')</title>

            <!-- Layout CSS -->
            <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

            <!-- FontAwesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

            <!-- Select2 CSS (DITAMBAHKAN) -->
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

            <!-- Styles tambahan dari halaman (robot.css dll) -->
            @yield('styles')
        </head>

        <body>

            <div class="app-wrapper">

                <aside class="sidebar">
                    <div class="logo-area">
                        <i class="fas fa-robot"></i>
                        <h2>SMART PATROL</h2>
                    </div>

                    <nav class="main-nav">
                        <ul>
                            <li class="menu-item">
                                <a href="{{ route('dashboard') }}"><i class="fas fa-satellite-dish"></i> Dashboard</a>
                            </li>

                            <li class="menu-item">
                                <a href="{{ route('penugasan') }}"><i class="fas fa-tasks"></i> Penugasan</a>
                            </li>

                            <li class="menu-item has-submenu">
                                <a href="#" class="submenu-toggle">
                                    <i class="fas fa-database"></i> Data
                                    <span class="arrow"><i class="fas fa-chevron-right"></i></span>
                                </a>
                                <ul class="submenu">
                                    <li class="submenu-item">
                                        <a href="{{ route('tambah_robot') }}"><i class="fas fa-robot"></i> Robot</a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="{{ route('rute.index') }}"><i class="fas fa-route"></i> Rute</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-item has-submenu">
                                <a href="#" class="submenu-toggle">
                                    <i class="fas fa-file-signature"></i> Laporan
                                    <span class="arrow"><i class="fas fa-chevron-right"></i></span>
                                </a>
                                <ul class="submenu">
                                    <li class="submenu-item">
                                        <a href="{{ route('insiden.index') }}"><i
                                                class="fas fa-exclamation-triangle"></i>
                                            Insiden</a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="{{ route('laporan.kondisi.index') }}"><i
                                                class="fas fa-exclamation-triangle"></i>
                                            Kondisi</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>

                    <div class="logout-section">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </aside>

                <main class="main-content">
                    <header class="top-header">
                        <div class="user-info">
                            Halo, {{ Auth::user()->name ?? 'Administrator' }}!
                        </div>
                    </header>

                    <section class="page-content">
                        @yield('content')
                    </section>
                </main>

            </div>

            <script src="{{ asset('js/sidebar.js') }}"></script>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            @yield('scripts')

        </body>

        </html>
