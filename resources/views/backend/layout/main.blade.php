@include('backend.layout.head')
<div class="main-wrapper">

    <!-- partial:partials/_sidebar.html -->
    @include('backend.layout.sidebar')
    <!-- partial -->

    <div class="page-wrapper">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar">
            <a href="#" class="sidebar-toggler">
                <i data-feather="menu"></i>
            </a>
            <div class="navbar-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (Auth::user()->name == 'manager')
                                <img class="wd-30 ht-30 rounded-circle"
                                    src="https://cdn-icons-png.flaticon.com/512/1253/1253667.png?w=740&t=st=1678872683~exp=1678873283~hmac=37c28d9e5b4b76f29dfee0dd8e409aa41cf8c8eeb5288b97bc25e223e3e50e29"
                                    alt="">
                            @else
                                <img class="wd-30 ht-30 rounded-circle"
                                    src="https://cdn-icons-png.flaticon.com/512/219/219983.png" alt="">
                            @endif
                        </a>
                        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                <div class="mb-3">
                                    @if (Auth::user()->name == 'manager')
                                        <img class="wd-80 ht-80 rounded-circle"
                                            src="https://cdn-icons-png.flaticon.com/512/1253/1253667.png?w=740&t=st=1678872683~exp=1678873283~hmac=37c28d9e5b4b76f29dfee0dd8e409aa41cf8c8eeb5288b97bc25e223e3e50e29"
                                            alt="">
                                    @else
                                        <img class="wd-80 ht-80 rounded-circle"
                                            src="https://cdn-icons-png.flaticon.com/512/219/219983.png" alt="">
                                    @endif
                                </div>
                                <div class="text-center">
                                    <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
                                    <p class="tx-12 text-muted">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <ul class="list-unstyled p-1">
                                <li class="dropdown-item py-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="route('logout')"
                                            onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                            class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="log-out"></i>
                                            <span>Log Out</span>
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->
        <div class="page-content">
            <div class="row">
                @yield('content')
            </div>
        </div>
        @include('backend.layout.footer')
