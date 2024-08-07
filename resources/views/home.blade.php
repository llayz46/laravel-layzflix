<x-layout title="Home">
    <x-header class="absolute inset-x-0 top-0 z-50" :input-transparent="true"/>

    <div class="relative isolate overflow-hidden pt-14">
        <img src="{{ asset('images/homepage-illustration.webp') }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
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
        <x-section-title>Top 3 most active users</x-section-title>
        <x-section-description>Our podium: Meet the 3 cinephiles who shine brightest through their activity and passion. Want to join them? Share your thoughts and climb the ranks!</x-section-description>
        <div class="grid grid-cols-1 md:grid-cols-3 mt-6 lg:mt-8">
            @if(count($topUsers) === 0)
                <x-section-description>Sorry, for the moment we can't provide you the 3 most active users.</x-section-description>
            @else
                @foreach($topUsers as $topUser)
                    <div class="sm:flex items-center">
                        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
                            <x-user-avatar class="h-20 w-20 w-full rounded-full border border-gray-300" :user="$topUser->user"/>
                        </div>
                        <div>
                            <div class="inline-flex gap-3">
                                <h4 class="text-lg font-bold">{{ $topUser->user->username }}</h4>
                                @if($topUser->user->isPremium())
                                    <x-profile-premium-badge/>
                                @endif
                            </div>
                            <p>{{ $topUser->user->bio }}</p>
                            <p class="mt-1">Post : {{ $topUser->reviews_count }} review.</p>
                        </div>
                    </div>
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

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl sm:text-center">
                <h2 class="text-3xl font-bold tracking-tight text-title sm:text-4xl">Lifetime access, one-time payment</h2>
                <p class="mt-6 text-lg leading-8 text-body">Pay one time and get lifetime access to the premium avantages.</p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl rounded-3xl ring-1 ring-gray-200 dark:ring-white/10 sm:mt-20 lg:mx-0 lg:flex lg:max-w-none">
                <div class="p-8 sm:p-10 lg:flex-auto">
                    <h3 class="text-2xl font-bold tracking-tight text-title">Lifetime premium</h3>
                    <p class="mt-6 text-base leading-7 text-body">Lorem ipsum dolor sit amet consect etur adipisicing elit. Itaque amet indis perferendis blanditiis repellendus etur quidem assumenda.</p>
                    <div class="mt-10 flex items-center gap-x-4">
                        <h4 class="flex-none text-sm font-semibold leading-6 text-accent-600">What’s included</h4>
                        <div class="h-px flex-auto bg-gray-100 dark:bg-white/10"></div>
                    </div>
                    <ul role="list" class="mt-8 grid grid-cols-1 gap-4 text-sm leading-6 text-body sm:grid-cols-2 sm:gap-6">
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-accent-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Premium profile badge
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-accent-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Access to who following you
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-accent-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Entry to annual conference
                        </li>
                        <li class="flex gap-x-3">
                            <svg class="h-6 w-5 flex-none text-accent-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Official member t-shirt
                        </li>
                    </ul>
                </div>
                <div class="-mt-2 p-2 lg:mt-0 lg:w-full lg:max-w-md lg:flex-shrink-0">
                    <div class="rounded-2xl bg-gray-50 dark:bg-neutral-900 py-10 text-center ring-1 ring-inset ring-gray-900/5 lg:flex lg:flex-col lg:justify-center lg:py-16">
                        <div class="mx-auto max-w-xs px-8">
                            <p class="text-base font-semibold text-body">Pay once, own it forever</p>
                            <p class="mt-6 flex items-baseline justify-center gap-x-2">
                                <span class="text-5xl font-bold tracking-tight text-title">$40</span>
                                <span class="text-sm font-semibold leading-6 tracking-wide text-body">USD</span>
                            </p>
                            <a href="{{ route('payment.index') }}" class="mt-10 block w-full rounded-md bg-accent-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-accent-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent-600">Subscribe</a>
                            <p class="mt-6 text-xs leading-5 text-body">Streamlined expense reports with instant access to invoices and receipts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
