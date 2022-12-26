<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="off-over"></div>
    
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark bg-white ">
            <div class="nav-container">
                <div class="brand-container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <svg class="rating-icon icon-star">
                            <use xlink:href="#svg-star"></use>
                        </svg>
                        
                    </a>
                    <div class="mobilemenu-trigger navigation-widget-mobile-trigger">
                        <!-- BURGER ICON -->
                        <div class="burger-icon inverted">
                        <!-- BURGER ICON BAR -->
                        <div class="burger-icon-bar"></div>
                        <!-- /BURGER ICON BAR -->

                        <!-- BURGER ICON BAR -->
                        <div class="burger-icon-bar"></div>
                        <!-- /BURGER ICON BAR -->

                        <!-- BURGER ICON BAR -->
                        <div class="burger-icon-bar"></div>
                        <!-- /BURGER ICON BAR -->
                        </div>
                        <!-- /BURGER ICON -->
                    </div>
                </div>

                <form method="get" action="" class="nav-search">
                    <input class="" name="keyword" type="text" placeholder="بحث" value="@if(isset($_GET['keyword'])) {{ $_GET['keyword'] }} @endif">
                    <button class="button-search" type="submit">
                        <svg class="interactive-input-icon icon-magnifying-glass">
                            <use xlink:href="#svg-magnifying-glass"></use>
                        </svg>
                    </button>
                </form>    
            </div>
        </nav>

        <main class="py-4">
        
            @yield('content')
        </main>

        @auth
            <div class="bottom-navbar">
                <div class="d-flex ">
                    <div class="nb-item {{ request()->is('u/'.Auth::user()->username) ? 'active' : '' }}"><a class="nav-link" href="{{ url('/u') }}/{{ Auth::user()->username }}">
                        
                    <!-- ICON PROFILE -->
                    <svg class="icon-profile">
                    <use xlink:href="#svg-profile"></use>
                    </svg>
                    <!-- /ICON PROFILE -->
                        <span>صفحتي الشخصيه</span></a></div>
                    <div class="nb-item {{ request()->is('edit-profile') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/edit-profile') }}">
                        
                        <!-- ICON SETTINGS -->
                        <svg class="icon-settings">
                        <use xlink:href="#svg-settings"></use>
                        </svg>
                        <!-- /ICON SETTINGS -->
                        <span>تعديل حسابي</span></a></div>
                    <div class="nb-item {{ request()->is('notifications') ? 'active' : '' }}"><a class="nav-link" href="{{ url('/notifications') }}">
                        
                        <!-- ICON NOTIFICATION -->
                        <svg class="icon-notification">
                        <use xlink:href="#svg-notification"></use>
                        </svg>
                        <!-- /ICON NOTIFICATION -->
                        <!-- USER AVATAR BADGE -->
                <div class="user-avatar-badge bottom-count">
                   
            
                    <!-- USER AVATAR BADGE CONTENT -->
                    <div class="user-avatar-badge-content">
                    <!-- HEXAGON -->
                    <div class="hexagon-dark-16-18 notes-count"></div>
                    <!-- /HEXAGON -->
                    </div>
                    <!-- /USER AVATAR BADGE CONTENT -->
            
                    <!-- USER AVATAR BADGE TEXT -->
                    
                                        
                                
                    <!-- USER AVATAR BADGE TEXT -->
                    <p class="user-avatar-badge-text" id="notes-count">0</p>
                    <!-- /USER AVATAR BADGE TEXT -->
                </div>
                <!-- /USER AVATAR BADGE -->
                        <span> الاشعارات</span></a></div>
                </div>
            </div>
        @else
            <!-- FLOATY BAR -->
            <aside class="floaty-bar logged-out">
                <!-- LOGIN BUTTON -->
                <a class="login-button button small primary" href="{{ url('/') }}">سجل الدخول</a>
                <!-- /LOGIN BUTTON -->
            </aside>
            <!-- /FLOATY BAR -->
        @endauth
    </div>
    @include('layouts.off-side')

 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
    <!-- app -->
    <script src="{{ asset('js/apps.js') }}"></script>

    <!-- XM_Plugins -->
    <script src="{{ asset('js/xm_plugins.min.js') }}"></script>

    <!-- global.hexagons -->
    <script src="{{ asset('js/global.hexagons.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/svg-loader.js') }}" defer></script>

    <script>
        @auth
            $( document ).ready(function() {
                realTime()
            });
            $('.whois').on('click', function(event) {
                $btn = $(this);
                event.preventDefault();
                $.ajax({
                    type:'post',
                    url:'/whois',
                    data:{
                        '_token':'{{ csrf_token() }}',
                        'id' : $(this).data('id')
                    },
                    success: function (data) {
                        console.log(data);
                            $btn.removeClass('whois');
                            $btn.addClass('request');
                            $btn.html(data);
                        
                        
                    },
                });
                return false;
            });
        @endauth

        function realTime() {
            $.ajax({
                type:'post',
                url:'/notescount',
                data:{
                    '_token':'{{ csrf_token() }}',
                },
                success: function (data) {
                    $("#notes-count").text(data)
                setTimeout(realTime, 30000);
                },
            });

        }
        @stack('script')
    </script>
</body>
</html>
