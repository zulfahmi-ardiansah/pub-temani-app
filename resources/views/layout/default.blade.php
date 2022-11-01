<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . " | Temani" : "Temani" }}</title>
    @include("include.css")
</head>

<body class="antialiased">
    <div class="preloader">
        <img src="{{ asset('/assets/img/logo/logo-and-text-white.svg') }}" alt="Temani" class="preloader-image">
    </div>
    <div class="wrapper">
        <header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ url('/home') }}">
                        <img src="{{ asset('/assets/img/logo/logo-and-text-white.svg') }}" width="70" height="20" alt="Temani" class="navbar-brand-image">
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                            aria-label="Open user menu">
                            <span class="avatar avatar-sm" style="background-size: contain; background-image: url('{{ asset(session()->get('admUser')->us_departement ? session()->get('admUser')->us_departement_rel->de_icon : '/assets/img/icon/user.png') }}')"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div style="font-weight: 600; color: white;">{{ session()->get("admUser")->us_name }}</div>
                                <div class="mt-1 small text-muted">{{ session()->get("admUser")->us_departement ? session()->get("admUser")->us_departement_rel->de_name : session()->get("admUser")->us_email }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow p-0">
                            <div class="d-block d-md-none">
                                <div class="dropdown-item bg-white d-block">
                                    <b>{{ session()->get("admUser")->us_name }}</b>
                                    <small class="d-block mt-1">{{ session()->get("admUser")->us_departement ? session()->get("admUser")->us_departement_rel->de_name : session()->get("admUser")->us_email }}</small>
                                </div>
                                <div class="dropdown-divider m-0"></div>
                            </div>
                            <a href="{{ url('/home/password') }}" class="dropdown-item">Ganti Kata Sandi</a>
                            <div class="dropdown-divider m-0"></div>
                            <a href="{{ url('/logout') }}" class="dropdown-item">Keluar</a>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Beranda
                                    </span>
                                </a>
                            </li>
                            @if (session()->get("admUser")->us_role == "EMPLOYEE")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/report/list') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Penanganan Aduan
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/report/history') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><polyline points="12 7 12 12 15 15" /></svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Riwayat Aduan
                                        </span>
                                    </a>
                                </li>
                            @endif
                            @if (session()->get("admUser")->us_role == "ADMIN")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/report/history') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><polyline points="12 7 12 12 15 15" /></svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Riwayat Aduan
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                        role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" />
                                                <line x1="12" y1="12" x2="20" y2="7.5" />
                                                <line x1="12" y1="12" x2="12" y2="21" />
                                                <line x1="12" y1="12" x2="4" y2="7.5" />
                                                <line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Data Dasar
                                        </span>
                                    </a>
                                    <div class="dropdown-menu p-0">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                <a class="dropdown-item" href="{{ url('/master/departement') }}">
                                                    Departemen
                                                </a>
                                                <a class="dropdown-item" href="{{ url('/master/category') }}">
                                                    Kategori
                                                </a>
                                                <a class="dropdown-item" href="{{ url('/master/employee') }}">
                                                    Pegawai
                                                </a>
                                                <a class="dropdown-item" href="{{ url('/master/user') }}">
                                                    Pengguna
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-wrapper">
            @yield("content")
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
						SIF UPJ Blended Learning
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-2 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Universitas Pembangunan Jaya
                                </li>
                                <li class="list-inline-item">
                                    <a href="./changelog.html" class="link-secondary" rel="noopener">Temani v.1.0</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include("include.js")
    <script>
        $(document).ready(function () {
            $(".preloader").delay(500).fadeOut(300);
        });
        window.onbeforeunload = function(event) {
            $(".preloader").fadeIn(300);
        }
    </script>
</body>

</html>
