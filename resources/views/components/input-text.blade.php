@props(['field', 'autocomplete' => false, 'type' => 'text'])

@php
    $classes = 'block w-full rounded-md bg-background border-0 py-1.5 text-title shadow-sm ring-1 ring-inset ring-gray-200 dark:ring-white/10 placeholder:text-body/50 focus:ring-2 focus:ring-inset focus:ring-primary-500 dark:focus:ring-primary-500 sm:text-sm sm:leading-6';
    if($errors->has($field)) {
        $classes .= ' ring-primary-500 dark:ring-primary-500';
    }
@endphp

<input type="{{ $type }}"
       name="{{ $field }}"
       id="{{ $field }}"
       @if($autocomplete)
           autocomplete="{{ $field }}"
       @endif
       class="{{ $classes }}"
       {{ $attributes }}>
