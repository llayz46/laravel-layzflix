@props(['tag'])

<{{ $tag }} class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium shadow text-body ring-1 ring-inset ring-white/10 cursor-default">
{{ $slot }}
</{{ $tag }}>
