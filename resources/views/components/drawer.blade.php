<div class="hidden relative z-10" data-dropdown-target="content">
    <!-- Background backdrop, show/hide based on slide-over state. -->
    <div class="fixed inset-0"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div class="pointer-events-auto w-screen max-w-md">
                    <div class="flex h-full flex-col divide-y divide-gray-200 dark:divide-white/10 bg-background shadow-xl">
                        <div class="flex min-h-0 flex-1 flex-col overflow-y-scroll py-6">
                            <div class="px-4 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-base font-semibold leading-6 text-title">Add to your playlist</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button" data-action="dropdown#toggle" class="relative rounded-md bg-background text-title hover:text-body focus:outline-none focus:ring-2 focus:ring-primary-500">
                                            <span class="absolute -inset-2.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                <form action="{{ route('playlist.addMedia') }}" method="post">
                                    @csrf
                                    <label for="playlist" class="block text-sm font-medium text-body">Playlist</label>
                                    <select id="playlist" name="playlist" class="mt-1 block w-full pl-3 pr-10 py-2 text-base text-title border-gray-200 dark:border-white/10 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                                        <option value="">Select a playlist</option>
                                        @foreach(auth()->user()->playlists as $playlist)
                                            <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="media_id" value="{{ $media['id'] }}">
                                    <input type="hidden" name="media_title" value="{{ $media['normalized_title'] }}">
                                    <input type="hidden" name="media_type" value="{{ $media['media_type'] }}">
                                    @if($media['poster_path'])
                                        <input type="hidden" name="media_poster" value="{{ $media['poster_path'] }}">
                                    @endif

                                    <x-button type="submit" class="mt-4">Add</x-button>
                                </form>
                            </div>
                        </div>
                        <div class="flex flex-shrink-0 justify-end px-4 py-4 gap-4">
                            <x-button type="secondary" data-action="dropdown#toggle" class="cursor-pointer">Cancel</x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
