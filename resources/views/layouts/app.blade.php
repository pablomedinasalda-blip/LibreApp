
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LibreApp') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f6fa !important;
            color: #26364b;
            font-family: 'Figtree', sans-serif;
        }

        .libre-app {
            min-height: 100vh;
            background: #f4f6fa;
        }

        .libre-main {
            min-height: 100vh;
            margin-left: 270px;
            padding: 30px;
            transition: margin .25s ease;
        }

        .libre-content {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
        }

        .libre-page-header {
            margin-bottom: 25px;
            padding: 24px 28px;
            background: #ffffff;
            border: 1px solid #e6eaf0;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(23, 43, 77, .05);
            color: #172b4d;
            font-size: 22px;
            font-weight: 800;
        }

        .libre-content main {
            color: #26364b;
        }

        @media (max-width: 767px) {
            .libre-main {
                margin-left: 0;
                padding: 18px;
            }

            .libre-page-header {
                padding: 18px;
                font-size: 19px;
            }
        }
    </style>
</head>

<body>
<div class="libre-app">

    @include('layouts.navigation')

    <div class="libre-main">

        @isset($header)
            <header class="libre-content libre-page-header">
                {{ $header }}
            </header>
        @endisset

        <main class="libre-content">
            {{ $slot }}
        </main>

    </div>

</div>
</body>
</html>
