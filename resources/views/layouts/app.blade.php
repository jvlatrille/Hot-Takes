<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('sauces.index') ? 'active' : '' }}"
                           href="{{ route('sauces.index') }}">
                           {{ __('All Sauces') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('sauces.create') ? 'active' : '' }}"
                           href="{{ route('sauces.create') }}">
                           {{ __('Add sauce') }}
                        </a>
                    </li>
                </ul>

                <a class="navbar-brand mx-auto d-flex flex-column align-items-center" href="{{ url('/') }}">
                    <img src="https://images.squarespace-cdn.com/content/v1/5c6ae13e8dfc8ca6f2c0d885/1550531492206-NJTJCB40L3SCMYNKE490/HOT+TAKES-logo-black.png?format=1500w"
                         alt="HOT TAKES Logo"
                         style="height: 100px;">
                    <span class="text-muted" style="font-size: 0.8rem;">
                        THE WEB'S BEST HOT SAUCE REVIEWS
                    </span>
                </a>

                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('login') }}">
                                   {{ __('Login') }}
                                </a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('register') }}">
                                   {{ __('Register') }}
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown"
                               class="nav-link dropdown-toggle"
                               href="#"
                               role="button"
                               data-bs-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="false"
                               v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form"
                                      action="{{ route('logout') }}"
                                      method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <div id="toast-container"
             aria-live="polite"
             aria-atomic="true"
             class="toast-container position-fixed bottom-0 end-0 p-3">
        </div>
    </div>
</body>
</html>
