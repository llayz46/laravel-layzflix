<x-layout title="Browse movies">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <div class="mt-6">
            <p class="text-sm font-medium text-body">We found {{ $response['total_results'] }} results for "{{ \Illuminate\Support\Str::title(request()->query('search')) }}"</p>
            <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                @if($response['total_results'] === 0)
                    <h2 class="text-2xl font-bold tracking-tight text-title text-center">Sorry, we found no movies matching your request.</h2>
                @endif
                @if($response['total_results'] > 0)
                    <div class="grid grid-cols-1 gap-x-6 gap-y-6 md:grid-cols-5 max-md:gap-y-8">
                        @foreach($response['results'] as $movie)
                            <x-card-film :movie="$movie"/>
                        @endforeach
                    </div>
                @endif
            </div>

            @if($totalPages > 0)
                <nav class="w-full flex items-center justify-between border-t border-gray-200 dark:border-white/10 px-4 py-3 sm:px-6 mt-4" aria-label="Pagination">
                    <div class="flex w-full">
                        @if($currentPage > 1)
                            <div class="ml-0 mr-auto">
                                <a href="{{ route('movies.search', ['search' => $query, 'page' => $currentPage - 1]) }}" class="relative inline-flex items-center rounded-md bg-background px-3 py-2 text-sm font-semibold text-title ring-1 ring-inset ring-gray-200 dark:ring-white/10 hover:bg-gray-50/5 focus-visible:outline-offset-0">Previous</a>
                            </div>
                        @endif

                        @if($currentPage < $totalPages)
                            <div class="mr-0 ml-auto">
                                <a href="{{ route('movies.search', ['search' => $query, 'page' => $currentPage + 1]) }}" class="relative ml-3 inline-flex items-center rounded-md bg-background px-3 py-2 text-sm font-semibold text-title ring-1 ring-inset ring-gray-200 dark:ring-white/10 hover:bg-gray-50/5 focus-visible:outline-offset-0">Next</a>
                            </div>
                        @endif
                    </div>
                </nav>
            @endif
        </div>
    </div>
</x-layout>
