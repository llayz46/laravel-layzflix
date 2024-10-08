<x-layout :title="Str::title($movie['normalized_title'])">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="my-8 sm:my-12 mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <x-breadcrumb :movie="$movie" :director="$director"/>
    </div>

    <div class="bg-background">
        <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="lg:grid lg:grid-cols-7 lg:grid-rows-1 lg:gap-x-8 lg:gap-y-10 xl:gap-x-16">
                <div class="lg:col-span-4 lg:row-end-1">
                    @if($movie['poster_path'])
                        <div class="overflow-hidden rounded-lg bg-gray-100">
                            <img src="https://image.tmdb.org/t/p/original{{ $movie['poster_path'] }}" sizes="(max-width: 1300px) 670px" class="object-cover size-full rounded-lg border border-gray-200 dark:border-neutral-800 shadow" loading="lazy" alt="Movie image of : {{ $movie['normalized_title'] }}">
                        </div>
                    @else
                        <div class="aspect-h-3 aspect-w-4 overflow-hidden rounded-lg bg-gray-100">
                            <img src="/storage/movie_image_placeholder.webp" alt="Sample image, we don't found the movie image" class="object-cover object-center">
                        </div>
                    @endif
                </div>

                <div class="mx-auto mt-14 max-w-2xl sm:mt-16 lg:col-span-3 lg:row-span-2 lg:row-end-2 lg:mt-0 lg:ml-0 lg:max-w-none" data-controller="dropdown">
                    <div class="flex flex-col-reverse">
                        <h1 class="mt-4 text-2xl font-bold tracking-tight text-title sm:text-3xl">{{ Str::title($movie['normalized_title']) }}</h1>

                        <div>
                            <h3 class="sr-only">Reviews</h3>
                            <div class="flex items-center">
                                @for($i = 0; $i < round($note); $i++)
                                    <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                    </svg>
                                @endfor
                                @if(round($note) !== 5)
                                    @for($i = round($note); $i < 5; $i++)
                                        <svg class="text-gray-300 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                        </svg>
                                    @endfor
                                @endif
                            </div>
                        </div>
                    </div>

                    <p class="mt-6 text-body">@if($movie['overview']) {{ $movie['overview'] }} @else We couldn't find the synopsis... @endif</p>

                    <div class="mt-4 space-y-2">
                        @if($movie['media_type'] === 'movie')
                            <p class="text-sm text-body"><strong>Director</strong> : @if($director) @foreach($director as $dir) {{ $dir['name'] }}@if(!$loop->last),@endif @if($loop->index === 5) @break @endif @endforeach @else No info... @endif</p>
                            <p class="text-sm text-body"><strong>Release date</strong> : @if($movie['release_date']) <time datetime="{{ $movie['release_date'] }}">{{ \Carbon\Carbon::createFromDate($movie['release_date'])->toFormattedDateString() }}</time> @else No info... @endif</p>
                        @else
                            <p class="text-sm text-body"><strong>Created by</strong> : @if($director) @foreach($director as $dir) {{ $dir['name'] }}@if(!$loop->last),@endif @if($loop->index === 5) @break @endif @endforeach @else No info... @endif</p>
                            <p class="text-sm text-body"><strong>First episode</strong> : @if($movie['first_air_date']) <time datetime="{{ $movie['first_air_date'] }}">{{ \Carbon\Carbon::createFromDate($movie['first_air_date'])->toFormattedDateString() }}</time> @else No info... @endif</p>
                        @endif
                    </div>

                    @guest
                        <span class="isolate inline-flex rounded-md shadow-sm mt-6">
                            <a href="{{ route('auth.login') }}" class="relative inline-flex items-center gap-x-1.5 rounded-l-md bg-background px-3 py-2 text-sm font-semibold text-title ring-1 ring-inset ring-gray-200 dark:ring-white/10 hover:bg-gray-200/50 dark:hover:bg-gray-50/5 focus:z-10">
                                <svg class="-ml-0.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 2c-1.716 0-3.408.106-5.07.31C3.806 2.45 3 3.414 3 4.517V17.25a.75.75 0 001.075.676L10 15.082l5.925 2.844A.75.75 0 0017 17.25V4.517c0-1.103-.806-2.068-1.93-2.207A41.403 41.403 0 0010 2z" clip-rule="evenodd" />
                                </svg>
                                Favorite
                            </a>
                            <p class="relative -ml-px inline-flex items-center rounded-r-md bg-background px-3 py-2 text-sm font-semibold text-title ring-1 ring-inset ring-gray-200 dark:ring-white/10 focus:z-10 cursor-default">{{ $favorites }}</p>
                        </span>
                    @endguest

                    @auth
                        <form action="{{ route('movies.favorite', ['id' => $movie['id'], 'mediaType' => $movie['media_type'], 'media' => \Illuminate\Support\Str::slug($movie['normalized_title'])]) }}" method="post" class="isolate inline-flex rounded-md shadow-sm mt-6">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                            <button class="relative inline-flex items-center gap-x-1.5 rounded-l-md bg-background px-3 py-2 text-sm font-semibold text-title ring-1 ring-inset ring-gray-200 dark:ring-white/10 hover:bg-gray-200/50 dark:hover:bg-gray-50/5 focus:z-10">
                                @if(str_contains(auth()->user()->favorite_media, $movie['id']))
                                    <svg class="-ml-0.5 h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 2c-1.716 0-3.408.106-5.07.31C3.806 2.45 3 3.414 3 4.517V17.25a.75.75 0 001.075.676L10 15.082l5.925 2.844A.75.75 0 0017 17.25V4.517c0-1.103-.806-2.068-1.93-2.207A41.403 41.403 0 0010 2z" clip-rule="evenodd" />
                                    </svg>
                                    Favorite
                                @else
                                    <svg class="-ml-0.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 2c-1.716 0-3.408.106-5.07.31C3.806 2.45 3 3.414 3 4.517V17.25a.75.75 0 001.075.676L10 15.082l5.925 2.844A.75.75 0 0017 17.25V4.517c0-1.103-.806-2.068-1.93-2.207A41.403 41.403 0 0010 2z" clip-rule="evenodd" />
                                    </svg>
                                    Add Favorite
                                @endif
                            </button>
                            <p class="relative -ml-px inline-flex items-center rounded-r-md bg-background px-3 py-2 text-sm font-semibold text-title ring-1 ring-inset ring-gray-200 dark:ring-white/10 focus:z-10 cursor-default">{{ $favorites }}</p>
                        </form>

                        <button type="button" data-action="dropdown#toggle keydown.esc->dropdown#toggle" class="rounded-full bg-primary-600 p-1.5 ml-2 text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                            </svg>
                        </button>

                        <x-drawer :media="$movie"/>
                    @endauth

                    @if ($movie['credits']['cast'])
                        <div class="mt-10 border-t border-gray-200 dark:border-white/10 pt-10">
                            <h3 class="text-sm font-medium text-title">Casting</h3>
                            <div class="prose prose-sm mt-4 text-body">
                                <ul role="list">
                                    @if(count($movie['credits']['cast']) > 10)
                                        @for($i = 0; $i < 10; $i++)
                                            <li>
                                                {{ $movie['credits']['cast'][$i]['name'] }}
                                                @if(!empty($movie['credits']['cast'][$i]['character']))
                                                    as <strong class="text-body">{{ $movie['credits']['cast'][$i]['character'] }}</strong>
                                                @endif
                                            </li>
                                        @endfor
                                    @else
                                        @foreach($movie['credits']['cast'] as $cast)
                                            <li>
                                                {{ $cast['name'] }}
                                                @if(!empty($cast['character']))
                                                    as <strong class="text-body">{{ $cast['character'] }}</strong>
                                                @endif
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if ($movie['genres'])
                        <div class="mt-10 border-t border-gray-200 dark:border-white/10 pt-10">
                            <h3 class="text-sm font-medium text-title">Genre</h3>
                            <ul class="mt-4">
                                @foreach($movie['genres'] as $genre)
                                    <x-badge tag="li">{{ $genre['name'] }}</x-badge>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <livewire:review :$movie />
            </div>
        </div>
    </div>
</x-layout>
