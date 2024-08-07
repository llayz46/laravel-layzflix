<x-layout title="{{ \Illuminate\Support\Str::title($user->username) }}'s profile">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <x-profile-header :user="$user" :numberOfMovies="$numberOfMovies" :numberOfReviews="$numberOfReviews" :followers="$followers"/>

        @if(count($movies) > 0)
            <div class="mt-6">
                <x-profile-section
                    title="Favorite movies"
                    underTitle="{{ \Illuminate\Support\Str::ucfirst($user->username) }}'s Last {{ count($movies) }} favorite movies"
                    class="grid-cols-1 md:grid-cols-5"
                >
                    <x-slot:buttons>
                        <x-button type="secondary" class="h-fit mt-auto" href="{{ route('profile.favorites', $user->username) }}">Explore</x-button>
                    </x-slot:buttons>
                    <x-slot:content>
                        @foreach($movies as $movie)
                            <x-card-film :movie="$movie"/>
                        @endforeach
                    </x-slot:content>
                </x-profile-section>
            </div>
        @endif

        @if(count($lastReviews) > 0)
            <div class="@if(!count($movies)) mt-6 @else mt-12 @endif">
                <x-profile-section
                    title="Recent reviews"
                    underTitle="{{ \Illuminate\Support\Str::ucfirst($user->username) }}'s Last {{ count($lastReviews) }} reviews"
                    class="grid-cols-1 lg:grid-cols-2"
                >
                    <x-slot:buttons>
                        <x-button type="secondary" href="{{ route('profile.reviews', $user->username) }}" class="h-fit mt-auto">Explore</x-button>
                    </x-slot:buttons>
                    <x-slot:content>
                        @foreach($lastReviews as $review)
                            <x-review-flim :review="$review" class="pb-5 border-b border-gray-200 dark:border-white/10"/>
                        @endforeach
                    </x-slot:content>
                </x-profile-section>
            </div>
        @endif

        <div class="@if(!count($lastReviews) || !count($movies)) mt-6 @else mt-12 @endif">
            <x-profile-section
                title="Recent playlist"
                underTitle="{{ \Illuminate\Support\Str::ucfirst($user->username) }}'s Last {{ count($playlists) }} playlists"
                class="grid-cols-1 lg:grid-cols-2"
            >
                <x-slot:buttons>
                    <div class="h-fit mt-auto space-x-2 inline-flex">
                        @auth
                            @if($user->id === auth()->user()->id)
                                <form class="relative flex items-center" method="post" action="{{ route('playlist.store') }}">
                                    @csrf
                                    <input name="name" class="block w-full rounded-md border-0 py-1.5 bg-background text-title shadow-sm ring-1 ring-inset ring-gray-200 dark:ring-white/10 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" id="name" type="text" required="required" placeholder="Create a playlist">
                                    <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                        <button type="submit" class="inline-flex items-center rounded border border-gray-200 dark:border-white/10 px-1 font-sans text-xs text-body hover:border-accent-300 transition-colors">Enter</button>
                                    </div>
                                </form>
                            @endif
                        @endauth
                        <x-button type="secondary" href="{{ route('profile.playlists', $user->username) }}">Explore</x-button>
                    </div>
                </x-slot:buttons>
                <x-slot:content>
                    @if(count($playlists) > 0)
                        @foreach($playlists as $playlist)
                            <x-playlist-card :playlist="$playlist" :user="$user"/>
                        @endforeach
                    @endif
                </x-slot:content>
            </x-profile-section>
        </div>
    </div>
</x-layout>
