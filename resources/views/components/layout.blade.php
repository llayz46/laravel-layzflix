@props(['title', 'footer' => true])

<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - {{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-background transition-colors" data-controller="theme" data-theme-target="body">
    {{ $slot }}

    @if($footer)
        <x-footer/>
    @endif

    @if(session('success') || session('error'))
        <x-notification status="{{ session('success') ? 'success' : 'error' }}"/>
    @endif
</body>
</html>
