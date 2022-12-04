<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/public/favicon.ico">
    <!-- connect csss -->
    <link rel="stylesheet" href="/public/front/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/front/css/bootstrap-icons.css">
    <link rel="stylesheet" href="/public/front/css/animate.css">
    <link rel="stylesheet" href="/public/front/css/style.css">
    <link rel="stylesheet" href="/public/front/css/media.css">
    <!-- connect font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- connect font -->
    @yield('styles')
</head>
<body>
    <style>
        /*natification css*/
        body header .natification .dropdown .dropdown-menu .nat-cont {
            display: flex;
            flex-wrap: nowrap;
            margin-bottom: .5rem;
        }
        body header .natification .dropdown .dropdown-menu .nat-wrapp .nat-cont .text-wrapper {
            display: flex;
        }
        body header .natification .dropdown .dropdown-menu .nat-wrapp .nat-cont .text-wrapper p {
            font-weight: normal;
            font-size: 12px;
            line-height: 14px;
            color: rgba(0, 0, 0, 0.5);
            overflow: hidden;
            text-overflow: ellipsis;
            -moz-box-orient: vertical;
            -webkit-box-orient: vertical;
            -ms-box-orient: vertical;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            -ms-line-clamp: 1;
            -ms-box-orient: vertical;
            -moz-line-clamp: 1;
            -moz-box-orient: vertical;
            line-clamp: 1;
            box-orient: vertical;
            margin-bottom: 0px;
        }
        header .natification .nat-cont .nat-ic {
            width: 12px;
            height: 12px;
            background: #0ACAA1;
            border-radius: 50%;
            margin-top: 2px;
            margin-right: 10px;
        }
        body header .natification .view-all {
            display: flex;
            justify-content: center;
            padding: 10px;
            background: #F9F9F9;
        }
        body header .natification .view-all:hover {
            text-decoration: none;
            background: rgba(0, 0, 0, .06);
        }
    </style>
        <style>
            .profile_header {
                position: relative;
            }
            .profile_header .dropdown-menu {
                border: 0px solid transparent;
                background: #FFFFFF;
                box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.1);
            }
            .profile_header .dropdown-menu .dropdown-item {
                font-size: 14px;
                padding: 10px 20px;
                font-weight: 500;
            }
            .profile_header .dropdown-menu .dropdown-item:active {
                background: #009172
            }
        </style>
    <div class="wrapper">


            <main class="" style="display: flex;flex-direction: column;justify-content: space-between;">
             
                    @include('layouts.header')
                    @yield('content')
                    @include('layouts.footer')

            </main>

    </div>




    <!-- connect scripts -->
    <script src="/public/front/js/jquery3.2.1.min.js"></script>
    <script src="/public/front/js/popper.min.js"></script>
    <script src="/public/front/js/bootstrap.min.js"></script>
    <script src="/public/front/js/wow.min.js"></script>
    <script src="/public/front/js/main.js"></script>
    @yield('scripts')
</body>

</html>
