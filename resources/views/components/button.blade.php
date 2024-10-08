@props(['type' => 'primary'])

@switch($type)
    @case('primary')
        <a {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600']) }}>{{ $slot }}</a>
        @break

    @case('secondary')
        <a {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-md bg-transparent px-3 py-2 text-sm font-semibold text-title shadow-sm ring-1 ring-inset ring-gray-200 hover:bg-gray-200/50 dark:ring-white/10 dark:hover:bg-white/5']) }}>{{ $slot }}</a>
        @break

    @case('danger')
        <button {{ $attributes->merge(['class' => 'inline-flex items-center rounded-md bg-transparent px-2.5 py-1 text-sm font-semibold text-title shadow-sm ring-1 ring-inset ring-gray-200 hover:bg-red-50/50 dark:ring-white/10 dark:hover:bg-red-700/5 transition-colors']) }}>{{ $slot }}</button>
        @break

    @case('submit')
        <button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600']) }}>{{ $slot }}</button>
        @break

    @case('submit-text')
        <button {{ $attributes->merge(['class' => 'underline text-sm text-body hover:text-title rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:ring-offset-background']) }}>{{ $slot }}</button>
        @break
@endswitch
