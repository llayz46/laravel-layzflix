<x-layout title="{{ \Illuminate\Support\Str::title($user->username) }}'s followers">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <x-profile-header :user="$user" :numberOfMovies="false" :numberOfReviews="false" :followers="false"/>

        <div class="mt-6">
            <div class="flex justify-between">
                <div>
                    <h2 class="text-base font-semibold leading-8 text-primary-500">Users following you ({{ $followers->count() }})</h2>
                    <p class="text-sm font-medium text-body">Browse all users who following you</p>
                </div>
                <x-button type="secondary" href="{{ route('profile.index', $user->username) }}" class="h-fit mt-auto">Back to profile</x-button>
            </div>
            <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-white/10">
                    @foreach($followers as $follower)
                        <li class="flex min-w-0 gap-x-4">
                            <x-user-avatar :user="$follower->user" class="h-12 w-12 flex-none rounded-full bg-gray-50"/>
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-title">{{ $follower->user->username }}</p>
                                <p class="mt-1 truncate text-xs leading-5 text-body">@if($follower->user->bio) {{ $follower->user->bio }} @else No bio... @endif</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="border-t border-gray-200 dark:border-white/10 pt-5 mt-5">
                    {{ $followers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>
