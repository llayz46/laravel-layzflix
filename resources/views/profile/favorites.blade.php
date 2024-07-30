<x-layout title="{{ \Illuminate\Support\Str::title($user->username) }}'s favorites movies">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <x-profile-header :user="$user" :numberOfMovies="$numberOfMovies" :numberOfReviews="$numberOfReviews"/>

        <div class="mt-6">
            <div class="flex justify-between">
                <div>
                    @if(count($movies) > 0)
                        <h2 class="text-base font-semibold leading-8 text-primary-500">All favorite movies</h2>
                        <p class="text-sm font-medium text-body">{{ \Illuminate\Support\Str::ucfirst($user->username) }}
                            's favorites movies</p>
                    @else
                        <h2 class="text-base font-semibold leading-8 text-primary-500">No favorite movie</h2>
                        <p class="text-sm font-medium text-body">{{ \Illuminate\Support\Str::ucfirst($user->username) }}
                            has no one favorite movie</p>
                    @endif
                </div>
                <x-button type="secondary" href="{{ route('profile.index', $user->username) }}" class="h-fit mt-auto">
                    Back to profile
                </x-button>
            </div>
            <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                <div class="grid grid-cols-1 gap-x-6 md:grid-cols-5 gap-y-6">
                    @if(count($movies) > 0)
                        @foreach($movies as $movie)
                            <x-card-film :movie="$movie"/>
                        @endforeach
                    @endif
                </div>

                @if($totalPages > 1)
                    <div class="mt-5">
                        <nav
                            class="w-full flex items-center justify-between border-t border-gray-200 dark:border-white/10 px-4 py-3 sm:px-6 mt-4"
                            aria-label="Pagination">
                            <div class="flex w-full">
                                @if($currentPage > 1)
                                    <div class="ml-0 mr-auto">
                                        <a href="{{ route('profile.favorites', ['user' => $user->username, 'page' => $currentPage - 1]) }}"
                                           class="relative inline-flex items-center rounded-md bg-background px-3 py-2 text-sm font-semibold text-title ring-1 ring-inset ring-gray-200 dark:ring-white/10 hover:bg-gray-50/5 focus-visible:outline-offset-0">Previous</a>
                                    </div>
                                @endif

                                @if($currentPage < $totalPages)
                                    <div class="mr-0 ml-auto">
                                        <a href="{{ route('profile.favorites', ['user' => $user->username, 'page' => $currentPage + 1]) }}"
                                           class="relative ml-3 inline-flex items-center rounded-md bg-background px-3 py-2 text-sm font-semibold text-title ring-1 ring-inset ring-gray-200 dark:ring-white/10 hover:bg-gray-50/5 focus-visible:outline-offset-0">Next</a>
                                    </div>
                                @endif
                            </div>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
