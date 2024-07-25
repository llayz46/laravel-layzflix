<input type="checkbox" {{ $attributes->merge(['class' => 'rounded border-gray-200 dark:border-white/10 bg-background text-primary-500 shadow-sm focus:ring-primary-500 focus:ring-offset-background cursor-pointer']) }}>
<span class="ms-2 text-sm text-title">{{ $slot }}</span>
