<x-layout title="Home">
    <x-header class="absolute inset-x-0 top-0 z-50" :input-transparent="true"/>

    <div class="relative isolate overflow-hidden pt-14">
        <img src="{{ asset('homepage-illustration.webp') }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-accent-500/75 to-accent-800/50 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-400 ring-1 ring-white/10 hover:ring-white/20">
                    Join our community to share your position. <a href="{{ route('auth.register') }}" class="font-semibold text-white"><span class="absolute inset-0" aria-hidden="true"></span>Register <span aria-hidden="true">&rarr;</span></a>
                </div>
            </div>
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Discover Movies Like Never Before</h1>
                <p class="mt-6 text-lg leading-8 text-gray-300">Join our community of movie enthusiasts! Explore reviews, share your opinions, and dive into the world of cinema with the latest insights and ratings. Uncover hidden gems and connect with fellow fans today!</p>
                <div class="mt-10 text-center gap-x-6">
                    <x-button href="{{ route('auth.register') }}">Get started</x-button>
                </div>
            </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-accent-500/75 to-accent-800/50 opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </div>

    <x-section>
        <x-section-title>The 3 highest-rated movies</x-section-title>
        <x-section-description>Discover our users' favorite picks! Dive into a collection that highlights the films our audience loves the most, offering a diverse range of cinematic excellence.</x-section-description>
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-3 xl:gap-x-8 mt-6 lg:mt-8">
            @if(count($topRatedMovies) === 0)
                <x-section-description>Sorry, for the moment we can't provide you the 3 highest-rated movies.</x-section-description>
            @else
                @foreach($topRatedMovies as $movie)
                    <x-card-film :movie="$movie"/>
                @endforeach
            @endif
        </div>
    </x-section>

    <x-section>
        <x-section-title>The last 3 reviews</x-section-title>
        <x-section-description>Stay updated with the latest insights from our community. Here are the most recent three reviews, offering fresh perspectives on the newest films and series. Discover what’s being said about the latest releases and find your next watch!</x-section-description>
        <div class="grid grid-cols-1 md:grid-cols-3 mt-6 lg:mt-8">
            @if(count($lastReviews) === 0)
                <x-section-description>Sorry, for the moment we can't provide you the 3 last reviews.</x-section-description>
            @else
                @foreach($lastReviews as $review)
                    <x-card-review :review="$review"/>
                @endforeach
            @endif
        </div>
    </x-section>
</x-layout>
