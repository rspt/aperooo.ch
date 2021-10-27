<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title>Apérooo</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Apérooo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">{{ __('site.home') }}</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('auth.register') }}" class="nav-link">{{ __('auth.create_account') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('auth.login') }}" class="nav-link">{{ __('auth.login') }}</a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('auth.logout') }}" class="nav-link">{{ Auth::user()->username }} - {{ _('auth.logout') }}</a>
                            </li>
                        @endauth

                        @if (session('locale') == 'fr')
                            <li class="nav-item">
                                <a href="/lang/en" class="nav-link">English</a>
                            </li>
                        @elseif (session('locale') == 'en')
                            <li class="nav-item">
                                <a href="/lang/fr" class="nav-link">Français</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            @yield('content')
        </div>

        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
