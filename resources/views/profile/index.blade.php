<x-layout title="{{ \Illuminate\Support\Str::title($user->username) }}'s profile">
    <x-header class="dark:shadow-gray-500/5"/>

    @dump($user)

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <div class="flex justify-between">
            <div>
                <div class="flex items-start space-x-5">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img class="h-16 w-16 rounded-full object-cover" src="{{ $user->avatar ? $user->imageUrl() : 'https://ui-avatars.com/api/?background=ebe6ef&name='. $user->name() .'&color=ea546c&font-size=0.5&semibold=true&format=svg' }}" alt="">
                            <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="pt-1.5">
                        <h1 class="text-2xl font-bold text-title">{{ \Illuminate\Support\Str::title($user->name()) }}</h1>
                        <p class="text-sm font-medium text-body">{{ \Illuminate\Support\Str::ucfirst($user->bio) }}</p>
                    </div>
                </div>
                <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-3 sm:space-y-0 sm:space-x-reverse">
                    @auth
                        <x-button class="cursor-not-allowed" type="secondary">Message</x-button>
                        @if($user->id === auth()->user()->id)
                            <x-button href="{{ route('settings.index') }}">Edit profile</x-button>
                        @else
                            <x-button class="cursor-not-allowed">Add friend</x-button>
                        @endif
                    @endauth

                    @guest
                        <x-button href="{{ route('auth.login') }}" type="secondary">Message</x-button>
                        <x-button href="{{ route('auth.login') }}">Add friend</x-button>
                    @endguest
                </div>
            </div>
            <div class="sm:mt-4 hidden sm:block">
                <x-badge tag="span">Test</x-badge>
                <x-badge tag="span">Option</x-badge>
            </div>
        </div>

        <div class="mt-6">
            <div class="flex justify-between">
                <div>
                    <h2 class="text-base font-semibold leading-8 text-primary-500">Favorite movies</h2>
                    <p class="text-sm font-medium text-body">User's Last 5 favorite movies</p>
                </div>
{{-- TODO : garder le même style de page mais juste faire une liste de tout les films fav style page browse--}}
                <x-button type="secondary" class="h-fit mt-auto cursor-not-allowed">Explore</x-button>
            </div>
            <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                <div class="grid grid-cols-1 gap-x-6 md:grid-cols-5 max-md:gap-y-10">
                    @foreach($movies as $movie)
                        <x-card-film :movie="$movie"/>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-12">
            <div class="flex justify-between">
                <div>
                    <h2 class="text-base font-semibold leading-8 text-primary-500">Recent reviews</h2>
                    <p class="text-sm font-medium text-body">User's Last 4 reviews</p>
                </div>
{{-- TODO : garder le même style de page mais juste faire une liste de tout les avis--}}
                <x-button type="secondary" class="h-fit mt-auto cursor-not-allowed">Explore</x-button>
            </div>
            <div class="mt-2 border-t border-gray-200 dark:border-white/10 pt-5">
                <div class="grid grid-cols-1 gap-x-6 lg:grid-cols-2 gap-y-10">
                    @for($i = 0; $i < 4; $i++)
                        <x-review-flim movie-title="The Gentlemen" review="Lorem ipsum dolor sit amet mazim kasd et no sit. Iusto amet diam accusam sit minim accusam iusto nulla vero lorem nam et. Commodo ea lorem dignissim eu consetetur. Elitr delenit justo sanctus sed erat sed et amet no possim sea zzril et nihil. Magna magna ut nibh amet soluta magna." class="pb-5 border-b border-gray-200 dark:border-white/10"/>
{{-- TODO : dynamiser tout ca, lien etc --}}
                    @endfor
                </div>
            </div>
        </div>

    </div>
</x-layout>
