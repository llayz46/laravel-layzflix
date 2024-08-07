<x-layout title="{{ $name }}'s movies & series">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <div class="mt-6">
            <p class="text-sm font-medium text-body">We found {{ count($response) }} results for "{{ $name }}"</p>
            <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                <div class="grid grid-cols-1 gap-x-6 gap-y-6 md:grid-cols-5 max-md:gap-y-8">
                    @foreach($response as $movie)
                        <x-card-film :movie="$movie"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout>
