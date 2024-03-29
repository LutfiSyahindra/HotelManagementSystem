<!-- partial:partials/_sidebar.html -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    Mitra<span>Hotel</span>
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item">
                        <a href=" {{ route('dashboard') }}" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#master" role="button" aria-expanded="false"
                            aria-controls="master">
                            <i class="link-icon" data-feather="server"></i>
                            <span class="link-title">Data Master</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="master">
                            <ul class="nav sub-menu">
                                @role('manager')
                                <li class="nav-item">
                                    <a href="room" class="nav-link">Data Kamar</a>
                                </li>
                                <li class="nav-item">
                                    <a href="service" class="nav-link">Data Fasilitas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="karyawan" class="nav-link">Data Karyawan</a>
                                </li>
                                @else
                                 <li class="nav-item">
                                    <a href="visit" class="nav-link">Pendataan Tamu</a>
                                </li>
                                <li class="nav-item">
                                    <a href="daftartamu" class="nav-link">Daftar Tamu</a>
                                </li>
                                <li class="nav-item">
                                    <a href="karyawan" class="nav-link">coba2</a>
                                </li>
                                @endrole
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="pages/apps/chat.html" class="nav-link">
                            <i class="link-icon" data-feather="message-square"></i>
                            <span class="link-title">Cash Opname</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/apps/calendar.html" class="nav-link">
                            <i class="link-icon" data-feather="calendar"></i>
                            <span class="link-title">Calendar</span>
                        </a>
                    </li>
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
                        <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                            value="sidebar-light" checked>
                        <label class="form-check-label" for="sidebarLight">
                            Light
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                            value="sidebar-dark">
                        <label class="form-check-label" for="sidebarDark">
                            Dark
                        </label>
                    </div>
                </div>
                <div class="theme-wrapper">
                    <h6 class="text-muted mb-2">Light Theme:</h6>
                    <a class="theme-item active" href="../demo1/dashboard.html">
                        <img src="{{ asset('backend/assets/images/screenshots/light.jpg') }}" alt="light theme">
                    </a>
                    <h6 class="text-muted mb-2">Dark Theme:</h6>
                    <a class="theme-item" href="../demo2/dashboard.html">
                        <img src="{{ asset('backend/assets/images/screenshots/dark.jpg')}}" alt="light theme">
                    </a>
                </div>
            </div>
        </nav>
        <!-- partial -->