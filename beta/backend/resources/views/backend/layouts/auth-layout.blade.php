<!DOCTYPE html>
<html lang="vn">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>@yield('pageTitle')</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="Craft admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="keywords"
        content="Craft, bootstrap, bootstrap 5, admin themes, dark mode, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Craft - Bootstrap 5 HTML Admin Dashboard Theme" />
    <meta property="og:url" content="https://themes.getbootstrap.com/product/craft-bootstrap-5-admin-dashboard-theme" />
    <meta property="og:site_name" content="Keenthemes | Craft" />
    <link rel="canonical" href="https://preview.keenthemes.com/craft" />
    <link rel="shortcut icon" href="./backend/assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('./backend/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('./backend/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Global Stylesheets Bundle-->
    <!--Begin::Google Tag Manager -->
    <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src = '../../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5FS8GGP');
    </script>
    <!--End::Google Tag Manager -->
    @stack('stylesheets')
    @livewireStyles
</head>

<body id="kt_body" class="auth-bg">
    <script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-theme-mode");
        } else {
            if (localStorage.getItem("data-theme") !== null) {
                themeMode = localStorage.getItem("data-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }
    </script>

    @yield('content')

    <script>
    var hostUrl = "../../assets/index.html";
    </script>

    <!--begin::Global Javascript Bundle(used by all pages)-->

    <script src="{{ asset('./backend/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('./backend/assets/js/scripts.bundle.js') }}"></script>

    <!--end::Global Javascript Bundle-->

    @stack('scripts')
    @livewireScripts
</body>

</html>