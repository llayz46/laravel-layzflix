@props(['playlist', 'user'])

<li class="overflow-hidden rounded-xl border border-gray-200 dark:border-white/10 list-none">
    <div class="flex items-center justify-between gap-x-4 border-b border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-neutral-900 p-6">
        <div class="text-sm font-medium leading-6 text-title">{{ $playlist->name }}</div>
        <div class="inline-flex gap-2">
            @auth
                @if(auth()->user()->id === $playlist->user_id)
                    <form action="{{ route('playlist.delete', $playlist) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-button type="danger" class="px-3 py-2">Delete</x-button>
                    </form>
                @endif
            @endauth

            <x-button type="secondary" :href="route('playlist.show', ['user' => $user->username, 'playlist' => $playlist, 'name' => Str::slug($playlist->name)])">View</x-button>
        </div>
    </div>
    <dl class="-my-3 divide-y divide-gray-200 dark:divide-white/10 px-6 py-4 text-sm leading-6">
        <div class="flex justify-between gap-x-4 py-3">
            <dt class="text-body">Created</dt>
            <dd class="text-title"><time datetime="{{ $playlist['created_at'] }}">{{ \Carbon\Carbon::createFromDate($playlist['created_at'])->toFormattedDateString() }}</time></dd>
        </div>
        <div class="flex justify-between gap-x-4 py-3">
            <dt class="text-body">Accessibility</dt>
            <dd class="flex items-start gap-x-2">
                @auth
                    @if(auth()->user()->id === $playlist->user_id)
                        <form action="{{ route('playlist.update', $playlist) }}" method="post">
                            @csrf
                            @method('PATCH')
                            @if($playlist->is_public)
                                <button class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-400/10 ring-green-600/20 dark:ring-green-500/20">Public</button>
                            @else
                                <button class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-red-700 dark:text-red-400 bg-red-50 dark:bg-red-400/10 ring-red-600/20 dark:ring-red-500/20">Private</button>
                            @endif
                        </form>
                    @endif
                @endauth

                @if((auth()->user() && !(auth()->user()->id === $playlist->user_id)) || !auth()->user())
                    @if($playlist->is_public)
                        <span class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-400/10 ring-green-600/20 dark:ring-green-500/20">Public</span>
                    @else
                        <span class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-red-700 dark:text-red-400 bg-red-50 dark:bg-red-400/10 ring-red-600/20 dark:ring-red-500/20">Private</span>
                    @endif
                @endif
            </dd>
        </div>
    </dl>
</li>
