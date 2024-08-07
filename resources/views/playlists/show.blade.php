<x-layout title="{{ \Illuminate\Support\Str::title($user->username) }} - {{ $playlist->name }}">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <x-profile-header :user="$user" :numberOfMovies="$datas['movies']" :numberOfReviews="$datas['reviews']" :followers="$datas['followers']"/>

        <div class="mt-6">
            <div class="flex justify-between">
                <div>
                    <h2 class="text-base font-semibold leading-8 text-primary-500">Playlist : {{ $playlist->name }}</h2>
                    <p class="text-sm font-medium text-body">Browse all movies / series inside of "{{ $playlist->name }}"    playlist</p>
                </div>
                <x-button type="secondary" href="{{ route('profile.index', $user->username) }}" class="h-fit mt-auto">
                    Back to profile
                </x-button>
            </div>
            <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                <div class="grid grid-cols-1 gap-x-6 md:grid-cols-5 gap-y-6">
                    @if($playlist->medias)
                        @foreach($playlist->getMedias() as $movie)
                            <div class="flex flex-col">
                                <x-card-film :movie="$movie"/>
                                @auth
                                    @if(auth()->user()->id === $playlist->user_id)
                                        <form action="{{ route('playlist.deleteMedia', ['playlist' => $playlist, 'media' => $movie['id']]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="media_id" value="{{$movie['id']}}">
                                            <input type="hidden" name="playlist" value="{{  $playlist->id }}">
                                            <x-button type="submit" class="mt-3 w-full">Delete {{ $movie['normalized_title'] }}</x-button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
