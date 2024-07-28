<x-layout title="{{ \Illuminate\Support\Str::title($user->username) }}'s profile">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <div class="flex justify-between">
            <div>
                <div class="flex items-start space-x-5">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <x-user-avatar class="h-16 w-16 rounded-full object-cover shadow-inner" :user="$user" :link="false"/>
                            <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="pt-1.5">
                        <h1 class="text-2xl font-bold text-title">{{ \Illuminate\Support\Str::title($user->username) }}</h1>
                        <p class="text-sm font-medium text-body">{{ \Illuminate\Support\Str::ucfirst($user->bio) }}</p>
                    </div>
                </div>
                <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-3 sm:space-y-0 sm:space-x-reverse">
                    @auth
                        @if($user->id !== auth()->user()->id)
                            <x-button class="cursor-not-allowed" type="secondary">Message</x-button>
                        @endif

                        @if($user->id === auth()->user()->id)
                            <x-button href="{{ route('settings.index') }}">Edit profile</x-button>
                            <x-button href="{{ route('profile.friends', $user->username) }}" type="secondary">Friend list</x-button>
                        @else
                            @if(!auth()->user()->isFriendWith($user))
                                <form action="{{ route('friend.add', $user) }}" method="post">
                                    @csrf
                                    <x-button type="submit">Add friend</x-button>
                                </form>
                            @else
                                <form action="{{ route('friend.delete', $user) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit">Remove friend</x-button>
                                </form>
                            @endif
                        @endif
                    @endauth

                    @guest
                        <x-button href="{{ route('auth.login') }}" type="secondary">Message</x-button>
                        <x-button href="{{ route('auth.login') }}">Add friend</x-button>
                    @endguest
                </div>
            </div>
            <div class="sm:mt-4 hidden sm:block">
                <x-badge tag="span">{{ $numberOfMovies }} Favorite movie(s)</x-badge>
                <x-badge tag="span">{{ $numberOfReviews }} Review(s)</x-badge>
            </div>
        </div>

        @if(count($movies) > 0)
            <div class="mt-6">
                <div class="flex justify-between">
                    <div>
                        <h2 class="text-base font-semibold leading-8 text-primary-500">Favorite movies</h2>
                        <p class="text-sm font-medium text-body">{{ \Illuminate\Support\Str::ucfirst($user->username) }}'s Last {{ count($movies) }} favorite movies</p>
                    </div>
                    <x-button type="secondary" class="h-fit mt-auto" href="{{ route('profile.favorites', $user->username) }}">Explore</x-button>
                </div>
                <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                    <div class="grid grid-cols-1 gap-x-6 md:grid-cols-5 gap-y-6">
                        @foreach($movies as $movie)
                            <x-card-film :movie="$movie"/>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if(count($lastReviews) > 0)
            <div class="@if(!count($movies)) mt-6 @else mt-12 @endif">
                <div class="flex justify-between">
                    <div>
                        <h2 class="text-base font-semibold leading-8 text-primary-500">Recent reviews</h2>
                        <p class="text-sm font-medium text-body">{{ \Illuminate\Support\Str::ucfirst($user->username) }}'s Last {{ count($lastReviews) }} reviews</p>
                    </div>
                    <x-button type="secondary" href="{{ route('profile.reviews', $user->username) }}" class="h-fit mt-auto">Explore</x-button>
                </div>
                <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                    <div class="grid grid-cols-1 gap-x-6 lg:grid-cols-2 gap-y-6">
                        @foreach($lastReviews as $review)
                            <x-review-flim :review="$review" class="pb-5 border-b border-gray-200 dark:border-white/10"/>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </div>
</x-layout>
