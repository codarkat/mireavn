<header class="mb-5">
    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="{{route('admin.dashboard')}}"><img src="{{asset('public/admin/assets/images/logo/logo.png')}}" alt="Logo" srcset=""></a>
            </div>
            <div class="header-top-right d-flex justify-content-center align-items-center">
                <a class="btn btn-outline-danger btn-sm pointer" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Đăng xuất</a>
                    <form action="{{route('admin.logout')}}" method="post" class="d-none" id="logout-form">@csrf</form>
                <!-- Burger button responsive -->
                <a class="burger-btn d-block d-xl-none pointer">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container">
            <ul>
                <li
                    class="menu-item">
                    <a href="{{route('admin.list-users')}}" class='menu-link'>
                        <i class="bi bi-brush-fill"></i>
                        <span>Điểm danh</span>
                    </a>
                </li>

                <li
                    class="menu-item">
                    <a href="{{route('admin.settings-page-vote')}}" class='menu-link'>
                        <i class="bi bi-tools"></i>
                        <span>Cài đặt phiếu bầu cử</span>
                    </a>
                </li>

                <li
                    class="menu-item">
                    <a href="{{route('admin.results')}}" class='menu-link'>
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Kết quả bầu cử</span>
                    </a>
                </li>



            </ul>
        </div>
    </nav>

</header>
