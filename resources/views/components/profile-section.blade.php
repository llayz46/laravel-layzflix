@props(['title', 'underTitle'])

<div class="flex justify-between">
    <div>
        <h2 class="text-base font-semibold leading-8 text-primary-500">{{ $title }}</h2>
        <p class="text-sm font-medium text-body">{{ $underTitle }}</p>
    </div>
    {{ $buttons }}
</div>
<div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
    <div {{ $attributes->merge(['class' => 'grid gap-x-6 gap-y-6']) }}>
        {{ $content }}
    </div>
</div>
