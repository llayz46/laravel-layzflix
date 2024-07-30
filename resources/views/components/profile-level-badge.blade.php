@props(['level'])

@php
    $color = match ($level) {
        1 => 'bg-gray-50 dark:bg-gray-400/10 text-gray-700 dark:text-gray-400 ring-gray-500/10 dark:ring-gray-500/20',
        2 => 'bg-lime-5 0 dark:bg-lime-400/10 text-lime-700 dark:text-lime-400 ring-lime-500/10 dark:ring-lime-500/20',
        3 => 'bg-green-50 dark:bg-green-400/10 text-green-700 dark:text-green-400 ring-green-500/10 dark:ring-green-500/20',
        4 => 'bg-emerald-50 dark:bg-emerald-400/10 text-emerald-700 dark:text-emerald-400 ring-emerald-500/10 dark:ring-emerald-500/20',
        5 => 'bg-teal-50 dark:bg-teal-400/10 text-teal-700 dark:text-teal-400 ring-teal-500/10 dark:ring-teal-500/20',
        6 => 'bg-cyan-50 dark:bg-cyan-400/10 text-cyan-700 dark:text-cyan-400 ring-cyan-500/10 dark:ring-cyan-500/20',
        7 => 'bg-sky-50 dark:bg-sky-400/10 text-sky-700 dark:text-sky-400 ring-sky-500/10 dark:ring-sky-500/20',
        8 => 'bg-blue-50 dark:bg-blue-400/10 text-blue-700 dark:text-blue-400 ring-blue-500/10 dark:ring-blue-500/20',
        9 => 'bg-indigo-50 dark:bg-indigo-400/10 text-indigo-700 dark:text-indigo-400 ring-indigo-500/10 dark:ring-indigo-500/20',
        10 => 'bg-violet-50 dark:bg-violet-400/10 text-violet-700 dark:text-violet-400 ring-violet-500/10 dark:ring-violet-500/20',
        11 => 'bg-purple-50 dark:bg-purple-400/10 text-purple-700 dark:text-purple-400 ring-purple-500/10 dark:ring-purple-500/20',
        12 => 'bg-fuchsia-50 dark:bg-fuchsia-400/10 text-fuchsia-700 dark:text-fuchsia-400 ring-fuchsia-500/10 dark:ring-fuchsia-500/20',
        13 => 'bg-pink-50 dark:bg-pink-400/10 text-pink-700 dark:text-pink-400 ring-pink-500/10 dark:ring-pink-500/20',
        14 => 'bg-rose-50 dark:bg-rose-400/10 text-rose-700 dark:text-rose-400 ring-rose-500/10 dark:ring-rose-500/20',
        15 => 'bg-red-50 dark:bg-red-400/10 text-red-700 dark:text-red-400 ring-red-500/10 dark:ring-red-500/20',
        16 => 'bg-orange-50 dark:bg-orange-400/10 text-orange-700 dark:text-orange-400 ring-orange-500/10 dark:ring-orange-500/20',
        17 => 'bg-amber-50 dark:bg-amber-400/10 text-amber-700 dark:text-amber-400 ring-amber-500/10 dark:ring-amber-500/20',
        default => 'bg-neutral-50 dark:bg-neutral-400/10 text-neutral-700 dark:text-neutral-400 ring-neutral-500/10 dark:ring-neutral-500/20',
    };
@endphp

<span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $color }}">Level {{ $level }}</span>
