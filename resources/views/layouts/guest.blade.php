
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LibreApp') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="
    margin: 0;
    min-height: 100vh;
    background: linear-gradient(135deg, #10213b 0%, #172b4d 55%, #294c72 100%);
    font-family: Arial, sans-serif;
">

<main style="
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 35px 20px;
        box-sizing: border-box;
    ">

    <div style="
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.30);
            box-sizing: border-box;
        ">

        {{ $slot }}

    </div>

</main>

</body>
</html>
