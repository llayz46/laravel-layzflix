@props(['title', 'footer' => true])

<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - {{ config('app.name') }}</title>
    <meta name="description" content="Your go-to place to share your thoughts on movies and TV shows, discover top picks, and join a community of film lovers.">
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-background transition-colors" data-controller="theme" data-theme-target="body">
    {{ $slot }}

    @if($footer)
        <x-footer/>
    @endif

    @if(session('success') || session('error'))
        <x-notification status="{{ session('success') ? 'success' : 'error' }}" title="{{ session('success') ? 'success' : 'error' }}"/>
    @endif
</body>
</html>
