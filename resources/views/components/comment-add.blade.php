@props(['movie'])

<div class="flex items-start space-x-4">
    <div class="flex-shrink-0">
        <x-user-avatar class="inline-block h-10 w-10 rounded-full"/>
    </div>
    <div class="min-w-0 flex-1">
        <form action="{{ route('review.add') }}" class="relative" method="post">
            @php $userReview = auth()->user()->reviews()->whereJsonContains('movie', ['id' => (string)$movie['id']])->first() @endphp
            @csrf
            @error('note')
                <p class="mb-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
            @error('comment')
                <p class="mb-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
            <div
                class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-200 dark:ring-white/10 focus-within:ring-2 focus-within:ring-primary-500 @error('comment') ring-red-500 dark:ring-red-500 @enderror<">
                <label for="comment" class="sr-only">Add your comment</label>
                <textarea rows="3" name="comment" id="comment"
                          class="block w-full resize-none border-0 bg-transparent py-1.5 text-title placeholder:text-body focus:ring-0 sm:text-sm sm:leading-6"
                          placeholder="Add your comment..." {{ $errors->has('comment') || $errors->has('note') ? 'autofocus' : '' }}>@if(session('review'))@if(session('review')['comment']){{ Str::trim(session('review')['comment']) }}@endif@endif @if($userReview){{ Str::trim($userReview->comment) }}@endif</textarea>
            </div>

            <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                <div class="flex items-center space-x-5">
                    <div class="mt-4 flex items-center" data-controller="rating">
                        <svg class="text-gray-300 dark:text-neutral-600 h-5 w-5 flex-shrink-0 cursor-pointer transition-colors" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-rating-target="stars">
                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                        </svg>
                        <svg class="text-gray-300 dark:text-neutral-600 h-5 w-5 flex-shrink-0 cursor-pointer transition-colors" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-rating-target="stars">
                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                        </svg>
                        <svg class="text-gray-300 dark:text-neutral-600 h-5 w-5 flex-shrink-0 cursor-pointer transition-colors" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-rating-target="stars">
                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                        </svg>
                        <svg class="text-gray-300 dark:text-neutral-600 h-5 w-5 flex-shrink-0 cursor-pointer transition-colors" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-rating-target="stars">
                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                        </svg>
                        <svg class="text-gray-300 dark:text-neutral-600 h-5 w-5 flex-shrink-0 cursor-pointer transition-colors" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-rating-target="stars">
                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                        </svg>
                        <input type="hidden" name="note" id="note" value="0" required data-rating-target="note">
                    </div>
                </div>
                <input type="hidden" name="movie[id]" id="movie[id]" value="{{ $movie['id'] }}">
                <input type="hidden" name="movie[title]" id="movie[title]" value="{{ $movie['normalized_title'] }}">
                <input type="hidden" name="movie[mediaType]" id="movie[mediaType]" value="{{ $movie['media_type'] }}">
                <div class="flex-shrink-0">
                    <x-button type="submit">@if($userReview) Update @else Post @endif</x-button>
                </div>
            </div>
        </form>
    </div>
</div>
