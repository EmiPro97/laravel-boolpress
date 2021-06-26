{{-- @extends('layouts.main')
@section('content')
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/admin') }}">Admin</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">Boolpress</div>
        </div>
    </div>
@endsection --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Window title --}}
        <title>Boolpress</title>

        {{-- JS --}}
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #343a40;
                color: #7e878b;
                font-family: 'Nunito', sans-serif;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #7e878b;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .m-b-0 {
                margin-bottom: 0;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div id="root"></div>
    </body>
</html>