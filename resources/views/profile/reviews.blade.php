<x-layout title="{{ \Illuminate\Support\Str::title($user->username) }}'s profile">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <x-profile-header :user="$user" :numberOfMovies="$movies" :numberOfReviews="$numberOfReviews"/>

        <div class="mt-6 w-full">
            <div class="flex justify-between">
                <div>
                    @if(count($reviews) > 0)
                        <h2 class="text-base font-semibold leading-8 text-primary-500">All reviews</h2>
                        <p class="text-sm font-medium text-body">{{ \Illuminate\Support\Str::ucfirst($user->username) }}'s Reviews</p>
                    @else
                        <h2 class="text-base font-semibold leading-8 text-primary-500">No reviews</h2>
                        <p class="text-sm font-medium text-body">{{ \Illuminate\Support\Str::ucfirst($user->username) }} has not written any reviews yet</p>
                    @endif
                </div>
                <x-button type="secondary" href="{{ route('profile.index', $user->username) }}" class="h-fit mt-auto">Back to profile</x-button>
            </div>
            @if(count($reviews) > 0)
                <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                    <div class="grid grid-cols-1 gap-x-6 lg:grid-cols-2 gap-y-6">
                        @foreach($reviews as $review)
                            <x-review-flim :review="$review" class="pb-5 border-b border-gray-200 dark:border-white/10"/>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $reviews->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>
