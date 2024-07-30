@props(['review'])

<div {{ $attributes->merge(['class' => "flex"]) }}>
    @if($review['movie']['poster_path'])
        <a href="{{ route('movies.show', ['id' => $review['movie']['id'], 'mediaType' => $review['movie']['media_type'], 'media' => \Illuminate\Support\Str::slug($review['movie']['normalized_title'])]) }}" class="mb-4 flex-shrink-0 sm:mb-0 mr-4 hover:opacity-35 transition-opacity">
            <img class="shadow h-full border border-gray-300 dark:border-neutral-800 bg-white text-gray-300 w-32 object-cover" src="https://image.tmdb.org/t/p/original{{ $review['movie']['poster_path'] }}" alt="">
        </a>
    @else
        <a href="{{ route('movies.show', ['id' => $review['movie']['id'], 'mediaType' => $review['movie']['media_type'], 'media' => \Illuminate\Support\Str::slug($review['movie']['normalized_title'])]) }}" class="mb-4 flex-shrink-0 sm:mb-0 mr-4 hover:opacity-35 transition-opacity">
            <img class="shadow h-full w-full border border-gray-300 dark:border-neutral-800 bg-white text-gray-300 sm:w-32 object-cover" src="{{ asset('movie_image_placeholder.webp') }}" alt="Sample image, we don't found the movie image">
        </a>
    @endif
    <div>
        <h4 class="text-lg font-bold text-title">{{ $review['movie']['normalized_title'] }}</h4>
        <div class="flex gap-4 items-center">
            <div class="my-2 flex items-center">
                @for($i =0; $i < $review['note']; $i++)
                    <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                    </svg>
                @endfor
            </div>
            <time class="text-body">{{ \Carbon\Carbon::createFromDate($review['created_at'])->toFormattedDateString() }}</time>
        </div>
        <p class="mt-1 text-body">{{ $review['comment'] }}</p>
    </div>
</div>
