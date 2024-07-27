@props(['review'])

<div class="pt-10 sm:pt-6 lg:pt-8 sm:inline-block sm:w-full sm:px-3 lg:px-4">
    <figure class="rounded-2xl bg-background border border-gray-200 dark:border-white/10 shadow p-8 text-sm leading-6 h-full flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-semibold text-title mb-2">{{ $review['movie']['title'] }}</h3>
            <blockquote class="text-title">
                <p>“{{ $review['comment'] }}”</p>
            </blockquote>
        </div>
        <figcaption class="mt-6 flex items-center gap-x-4">
            <x-user-avatar :user="$review['user']" class="h-10 w-10 rounded-full"/>
            <div>
                <div class="font-semibold text-title">{{ $review['note'] . '/5' }}</div>
                <div class="text-body">{{ '@' . $review['user']['username'] }}</div>
            </div>
        </figcaption>
    </figure>
</div>
