<x-layout title="{{ \Illuminate\Support\Str::title($user->username) }}'s profile">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <x-profile-header :user="$user" :numberOfMovies="$numberOfMovies" :numberOfReviews="$numberOfReviews"/>

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
