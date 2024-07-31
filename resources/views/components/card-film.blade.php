@props(['movie'])

<a href="{{ route('movies.show', ['id' => $movie['id'], 'mediaType' => $movie['media_type'], 'media' => \Illuminate\Support\Str::slug($movie['normalized_title'])]) }}" {{ $attributes->merge(['class' => "overflow-hidden rounded-lg bg-background border border-gray-200 dark:border-white/10 shadow group relative"]) }}>
    <span class="sr-only">Link to {{ $movie['normalized_title'] }}</span>
    @if($movie['poster_path'])
        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" class="group-hover:opacity-35 transition-opacity h-full w-full" alt="Poster of : {{ $movie['normalized_title'] }}" sizes="(max-width: 1300px) 300px" loading="lazy">
    @else
        <div role="status" class="animate-pulse md:flex md:items-center h-full aspect-[16/24] w-full">
            <div class="flex items-center justify-center w-full h-full bg-gray-300 rounded sm:w-96 dark:bg-gray-700">
                <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                    <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                </svg>
            </div>
        </div>
    @endif
    <div class="hidden group-hover:block position absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
        <h3 class="text-lg font-semibold text-title text-center">{{ $movie['normalized_title'] }}</h3>
        @if(isset($movie['release_date']))
            <p class="mt-1 text-sm text-body">{{ $movie['release_date'] }}</p>
        @elseif(isset($movie['first_air_date']))
            <p class="mt-1 text-sm text-body">{{ $movie['first_air_date'] }}</p>
        @endif
    </div>
</a>
