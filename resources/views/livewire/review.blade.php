<div class="w-full max-w-2xl lg:col-span-4 lg:max-w-none">
    <div class="mx-auto mt-16 w-full max-w-2xl lg:col-span-4 lg:mt-0 lg:max-w-none">
        <div>
            <div class="border-b border-gray-200 dark:border-white/10 mb-10">
                <p class="border-transparent text-title whitespace-nowrap border-b-2 py-6 text-sm font-medium">Reviews</p>
            </div>

            <div class="-mb-10">
                <h3 class="sr-only">Reviews</h3>
                @foreach($reviews as $review)
                    <div @class(['flex space-x-4 text-sm text-body w-full mb-10', 'border-b border-gray-200 dark:border-white/10' => !$loop->last]) wire:key="{{ $review->id }}">
                        <div class="block w-fit min-w-10">
                            <x-user-avatar class="h-10 w-10 rounded-full bg-gray-100" :user="$review['user']"/>
                        </div>
                        <div class="block pb-10">
                            <h3 class="font-medium text-title">{{ $review['user']['username'] }}</h3>
                            <p><time datetime="{{ $review['created_at'] }}">{{ \Carbon\Carbon::createFromDate($review['created_at'])->toFormattedDateString() }}</time></p>

                            <div class="mt-4 flex items-center">
                                @for($i =0; $i < $review['note']; $i++)
                                    <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                    </svg>
                                @endfor
                            </div>

                            <div class="prose prose-sm mt-4 max-w-none text-body">
                                <p>{{ Str::ucfirst($review['comment']) }}</p>
                            </div>

                            @auth
                                @if($review->user_id === auth()->user()->id)
                                    <form wire:submit="delete({{ $review }})" class="mt-4">
                                        <x-button type="danger">Delete</x-button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            @if($reviews->hasPages())
                <div class="border-t border-gray-200 dark:border-white/10 py-5 mt-10">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>

    <div class="mx-auto mt-16 w-full max-w-2xl lg:col-span-4 lg:pt-8 lg:mt-0 lg:max-w-none">
        @auth
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <x-user-avatar class="inline-block h-10 w-10 rounded-full"/>
                </div>
                <div class="min-w-0 flex-1">
                    <form wire:submit.prevent="save" class="relative">
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
                            <textarea rows="3" wire:model="comment" name="comment" id="comment"
                                      class="block w-full resize-none border-0 bg-transparent py-1.5 text-title placeholder:text-body focus:ring-0 sm:text-sm sm:leading-6"
                                      placeholder="Add your comment..." {{ $errors->has('comment') || $errors->has('note') ? 'autofocus' : '' }}></textarea>
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
                                    <input type="hidden" name="note" wire:model="note" id="note" value="0" required data-rating-target="note">
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <x-button type="submit">@if($userReview) Update @else Post @endif</x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endauth
        @guest
            <div class="flex justify-center mt-16 lg:mt-0">
                <div class="w-fit relative rounded-full px-3 py-1 text-sm leading-6 text-body ring-1 ring-gray-200 dark:ring-white/10 group">
                    You must be logged in to add a comment. <a href="{{ route('auth.login') }}" class="font-semibold text-primary-500 group-hover:text-primary-400"><span class="absolute inset-0" aria-hidden="true"></span>Please sign in <span aria-hidden="true">&rarr;</span></a>
                </div>
            </div>
        @endguest
    </div>
    @if(session('reviewSuccess') || session('reviewError'))
        <x-notification status="{{ session('reviewSuccess') ? 'reviewSuccess' : 'reviewError' }}" title="{{ session('reviewSuccess') ? 'success' : 'error' }}"/>
    @endif
</div>
