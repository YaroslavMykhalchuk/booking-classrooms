<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
</head>
<body>
    <nav class="navbar navbar-light bg-light d-md-none px-3">
        <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
            ☰ Меню
        </button>
    </nav>

    <div class="d-flex">
        <div class="offcanvas-md offcanvas-start bg-light p-3 d-md-block position-fixed" 
            tabindex="-1" 
            id="adminSidebar" 
            style="width: 250px; min-height: 100vh;">
            <div class="offcanvas-header d-md-none">
                <h5 class="offcanvas-title">Admin Panel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            
            <a href="{{ route('home') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none d-none d-md-flex">
            <span class="fs-5">Повернутися назад</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : 'link-dark' }}"><i class="bi bi-speedometer2"></i> Адмін панель</a>
                </li>
                <li>
                    <a href="{{ route('admin.rooms') }}" class="nav-link {{ request()->routeIs('admin.rooms') ? 'active' : 'link-dark' }}"><i class="bi bi-door-open"></i> Аудиторії</a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : 'link-dark' }}"><i class="bi bi-people"></i> Користувачі</a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu text-small shadow">
                    <li>
                        <button type="button" 
                            class="dropdown-item" 
                            data-bs-toggle="modal" 
                            data-bs-target="#changePasswordModal">
                            Змінити пароль
                        </button>
                    </li>
                    <li>
                        <button type="button" 
                            class="dropdown-item"
                            data-bs-toggle="modal" 
                            data-bs-target="#changeEmailModal">
                            Змінити пошту
                        </button>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Вийти</a></li>
                </ul>
            </div>
        </div>
    </div>

    <main class="main my-3">
        <div class="container">
            @yield('content')
        </div>

        {{-- change password modal --}}
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="changePasswordModalLabel">Змінити пароль</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Поточний пароль</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Новий пароль</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmNewPassword" class="form-label">Підтвердіть новий пароль</label>
                            <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                        <button type="submit" class="btn btn-primary" id="changePasswordButton">Змінити пароль</button>
                    </div>
                </form>
            </div>
        </div>

    </main>
    {{-- change email modal --}}
    <div class="modal fade" id="changeEmailModal" tabindex="-1" aria-labelledby="changeEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="changeEmailModalLabel">Змінити пошту</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.change.email') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="newEmail" class="form-label">Введіть нову пошту</label>
                            <input type="email" class="form-control" id="newEmail" name="newEmail" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                        <button type="submit" class="btn btn-primary" id="changeEmailButton">Змінити пошту</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>