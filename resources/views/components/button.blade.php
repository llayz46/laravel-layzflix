@props(['type' => 'primary'])

@switch($type)
    @case('primary')
        <a {{ $attributes->merge(['class' => 'inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600']) }}>{{ $slot }}</a>
        @break

    @case('secondary')
        <a {{ $attributes->merge(['class' => 'inline-flex items-center rounded-md bg-background px-3 py-2 text-sm font-semibold text-title shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-white/10 hover:bg-gray-50 dark:hover:bg-white/5']) }}>{{ $slot }}</a>
        @break
@endswitch
