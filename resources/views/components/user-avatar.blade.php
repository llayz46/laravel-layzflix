@props(['user' => auth()->user(), 'link' => true])

@auth
    @if($link)
        <a href="{{ route('profile.index', $user->username) }}" class="group">
            <img {{ $attributes->merge(['class' => 'group-hover:scale-105 transition']) }}
                 @if ($user !== auth()->user())
                     src="{{ $user->avatar ? $user->imageUrl() : 'https://ui-avatars.com/api/?background=ebe6ef&name='. $user->username .'&color=ea546c&font-size=0.5&semibold=true&format=svg' }}"
                 @else
                     src="{{ auth()->user()->avatar ? auth()->user()->imageUrl() : 'https://ui-avatars.com/api/?background=ebe6ef&name='. auth()->user()->username .'&color=ea546c&font-size=0.5&semibold=true&format=svg' }}"
                 @endif
                 alt="User avatar">
        </a>
    @else
        <img {{ $attributes->merge(['class' => 'group-hover:scale-105 transition']) }}
             @if ($user !== auth()->user())
                 src="{{ $user->avatar ? $user->imageUrl() : 'https://ui-avatars.com/api/?background=ebe6ef&name='. $user->username .'&color=ea546c&font-size=0.5&semibold=true&format=svg' }}"
             @else
                 src="{{ auth()->user()->avatar ? auth()->user()->imageUrl() : 'https://ui-avatars.com/api/?background=ebe6ef&name='. auth()->user()->username .'&color=ea546c&font-size=0.5&semibold=true&format=svg' }}"
             @endif
             alt="User avatar">
    @endif
@endauth

@guest
    @if($link)
        <a href="{{ route('profile.index', $user->username) }}" class="group">
            <img {{ $attributes->merge(['class' => 'group-hover:scale-105 transition']) }}
                 src="{{ $user->avatar ? $user->imageUrl() : 'https://ui-avatars.com/api/?background=ebe6ef&name='. $user->username .'&color=ea546c&font-size=0.5&semibold=true&format=svg' }}"
                 alt="User avatar">
        </a>
    @else
        <img {{ $attributes }}
             src="{{ $user->avatar ? $user->imageUrl() : 'https://ui-avatars.com/api/?background=ebe6ef&name='. $user->username .'&color=ea546c&font-size=0.5&semibold=true&format=svg' }}"
             alt="User avatar">
    @endif
@endguest
