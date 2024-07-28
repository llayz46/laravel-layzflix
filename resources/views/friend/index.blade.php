<x-layout title="{{ \Illuminate\Support\Str::title($user->username) }}'s profile">
    <x-header class="dark:shadow-gray-500/5"/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <x-profile-header :user="$user" :numberOfMovies="false" :numberOfReviews="false"/>

        <div class="mt-6">
            <div class="flex justify-between">
                <div>
                    <h2 class="text-base font-semibold leading-8 text-primary-500">Friends list</h2>
                    <p class="text-sm font-medium text-body">Browse your friends list</p>
                </div>
                <x-button type="secondary" href="{{ route('profile.index', $user->username) }}" class="h-fit mt-auto">Back to profile</x-button>
            </div>
            <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($friends as $friend)
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <x-user-avatar :user="$friend" class="h-12 w-12 flex-none rounded-full bg-gray-50"/>
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-title">{{ $friend->username }}</p>
                                    <p class="mt-1 truncate text-xs leading-5 text-body">@if($friend->bio) {{ $friend->bio }} @else No bio... @endif</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <form action="{{ route('friend.delete', $friend) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="danger">Remove friend</x-button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="border-t border-gray-200 dark:border-white/10 pt-5 mt-5">
                    {{ $friends->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>
