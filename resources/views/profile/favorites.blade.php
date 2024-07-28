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
                        <x-button class="cursor-not-allowed" type="secondary">Message</x-button>
                        @if($user->id === auth()->user()->id)
                            <x-button href="{{ route('settings.index') }}">Edit profile</x-button>
                        @else
                            <x-button class="cursor-not-allowed">Add friend</x-button>
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

        <div class="mt-6">
            <div class="flex justify-between">
                <div>
                    @if(count($movies) > 0)
                        <h2 class="text-base font-semibold leading-8 text-primary-500">All favorite movies</h2>
                        <p class="text-sm font-medium text-body">{{ \Illuminate\Support\Str::ucfirst($user->username) }}'s favorites movies</p>
                    @else
                        <h2 class="text-base font-semibold leading-8 text-primary-500">No favorite movie</h2>
                        <p class="text-sm font-medium text-body">{{ \Illuminate\Support\Str::ucfirst($user->username) }} has no one favorite movie</p>
                    @endif
                </div>
                <x-button type="secondary" href="{{ route('profile.index', $user->username) }}" class="h-fit mt-auto">Back to profile</x-button>
            </div>
            <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                <div class="grid grid-cols-1 gap-x-6 md:grid-cols-5 gap-y-6">
                    @if(count($movies) > 0)
                        @foreach($movies as $movie)
                            <x-card-film :movie="$movie"/>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
