<x-layout title="{{ \Illuminate\Support\Str::title($user->username) }}'s favorites movies">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <x-profile-header :user="$user" :numberOfMovies="$numberOfMovies" :numberOfReviews="$numberOfReviews"/>

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
