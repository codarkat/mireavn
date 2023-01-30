<div class="topbar topbar-dark bg-dark d-flex">
    <div class="container justify-content-center align-items-center">
        <div class="topbar-text">GIỮ GÌN SỨC KHỎE, THẬN TRỌNG VỚI COVID-19</div>
    </div>
</div>
<header class="bg-light shadow-sm navbar-sticky">
    <div class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand d-none d-sm-block me-4 order-lg-1" href="{{route('main.index')}}">
                <img src="{{asset('public/main/img/logo-dark.png')}}" width="142" alt="MIREA">
            </a>
            <a class="navbar-brand d-sm-none flex-shrink-0 me-2" href="{{route('main.index')}}">
                <img src="{{asset('public/main/img/logo-icon.png')}}" width="74" alt="MIREA">
            </a>
            <div class="navbar-toolbar d-flex align-items-center order-lg-3">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @if (Route::has('user.login'))
                    @auth
                        <a class="btn btn-outline-primary rounded-pill" href="{{route('user.user-settings')}}" rel="noopener"><i class="ci-user-circle me-2"></i>Tài khoản</a>
                    @else
                        <a class="btn btn-primary rounded-pill" href="{{route('user.login')}}" rel="noopener"><i class="ci-sign-in me-2"></i>Đăng nhập</a>
                    @endauth
                @endif
            </div>
            <div class="collapse navbar-collapse me-auto order-lg-2" id="navbarCollapse">
                <hr class="d-lg-none my-3">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{route('main.index')}}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('user.friends')}}">Bạn bè</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pointer" data-bs-toggle="dropdown" data-bs-auto-close="outside">FB Group</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="https://www.facebook.com/groups/chidoanmirea" target="_blank">CHI ĐOÀN</a></li>
                            <li><a class="dropdown-item" href="https://www.facebook.com/groups/196061837600073" target="_blank">ĐƠN VỊ</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="https://www.facebook.com/LHSVN.RTU.MIREA" target="_blank">FB Fanpage</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pointer" data-bs-toggle="dropdown" data-bs-auto-close="outside">CLUB</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('main.club-ikbo')}}">{{config('app.club_name')}}</a></li>
{{--                            <li><a class="dropdown-item" href="{{route('main.club-mirea-fc')}}">MIREA FC</a></li>--}}
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
