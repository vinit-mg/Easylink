<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Scripts -->

    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/quill/quill.snow.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/quill/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/remixicon/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <script src="{{asset('build/static/app4.js')}}"></script>
    <script src="{{asset('build/static/field.js')}}"></script>

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo top-logo d-flex align-items-center">
                <img src="{{ asset('assets/img/easylink-logo.svg') }}" alt="">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="pagetitle m-d-none">
            <h1>{{ $header }}</h1>
        </div><!-- End Page Title -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item">
                    <a class="nav-link nav-icon" href="#">
                        <i class="bi bi-printer"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-primary badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="{{asset('assets/img/messages-1.jpg')}}" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="{{asset('assets/img/messages-2.jpg')}}" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="{{asset('assets/img/messages-3.jpg')}}" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->
                <li class="nav-item dropdown pe-3 mp-5">
                    <div id="mini-nav">
                        <div class="dropdown select-language">
                            <!-- <a data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" previewlistener="true" class="select-lg">
                                <span id="current-lang"><img src="https://cdn.parcellab.com/img/flags/dk.png" class="flag" alt="Flag representing language"> Dansk</span>
                                <span class="caret"></span>
                            </a> -->
                            <!-- <ul id="lang-switcher-list" class="dropdown-menu select-lg-menu">
                                <li><a href="?lang=en" previewlistener="true"><img src="https://cdn.parcellab.com/img/flags/us.png" class="flag" alt="Flag representing language"> English</a></li>
                                <li><a href="?lang=da" previewlistener="true"><img src="https://cdn.parcellab.com/img/flags/dk.png" class="flag" alt="Flag representing language"> Dansk</a></li>
                            </ul> -->

                            @php
                            $currentLanguage = Auth::check() ? Auth::user()->language : 'en';
                            $currentLanguageName = JoeDixon\Translation\Language::where('language', $currentLanguage)->first()->name ?? 'English';
                            @endphp

                            <a data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" previewlistener="true" class="select-lg">
                                <span id="current-lang">
                                    <img src="https://cdn.parcellab.com/img/flags/{{ $currentLanguage }}.png" class="flag">
                                    {{ $currentLanguageName }}
                                </span>
                                <span class="caret"></span>
                            </a>

                            <ul id="lang-switcher-list" class="dropdown-menu select-lg-menu">
                                @foreach(JoeDixon\Translation\Language::all() as $language)
                                <li>
                                    <a href="#" onclick="event.preventDefault(); switchLanguage('{{ $language->language }}');">
                                        <img src="https://cdn.parcellab.com/img/flags/{{ $language->language }}.png" class="flag">
                                        {{ $language->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>

                            <form id="language-form" action="{{ route('language.switch') }}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="language" id="selected-language">
                            </form>

                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="{{asset('assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
                        <!--<span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>-->
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>Web Designer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item d-flex align-items-center">

                                <i class="bi bi-person"></i>
                                <span>{{ __('Profile') }}</span>

                            </a>

                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span> {{ __('Log Out') }}</span>
                                </a>
                            </form>

                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li>

                <!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        @include('admin.layouts.navigation')
        <div class="poweredby">
            <p class="text-center">Powered for</p>
            <a href="index.html" class="align-items-center d-flex justify-content-center logo bottom-logo">
                <img src="{{asset('assets/img/main-logo.svg')}}" alt="">
            </a>
        </div>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        {{ $slot }}
    </main><!-- End #main -->
    @routes
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/quill/quill.js')}}"></script>
    <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('assets/vendor/dist/js/select2.full.min.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('assets/js/admin.js')}}"></script>

    <script>
        function switchLanguage(language) {
            document.getElementById('selected-language').value = language;
            document.getElementById('language-form').submit();
        }
    </script>

</body>

</html>