<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title>Apérooo</title>
    </head>
    <body>
        <nav>
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                @guest
                    <li>
                        <a href="{{ route('auth.register') }}">Create account</a>
                    </li>
                    <li>
                        <a href="{{ route('auth.login') }}">Login</a>
                    </li>
                @endguest
                @auth
                    <li>
                        <a href="{{ route('auth.logout') }}">{{ Auth::user()->username }} - Logout</a>
                    </li>
                @endauth
            </ul>
        </nav>

        @yield('content')
    </body>
</html>
