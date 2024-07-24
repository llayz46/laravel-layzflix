@props(['src', 'movieTitle'])

<a {{ $attributes->merge(['class' => "overflow-hidden rounded-lg bg-background border border-gray-200 dark:border-gray-200/50 shadow group relative"]) }}>
    <img src="{{ $src }}" class="group-hover:opacity-35 transition-opacity" alt="">
    <div class="hidden group-hover:block position absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
        <h3 class="text-lg font-semibold text-title">{{ $movieTitle }}</h3>
        <p class="mt-1 text-sm text-gray-400">1994 &middot; Drama, Crime</p>
    </div>
</a>
