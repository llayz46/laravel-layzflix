<!--
  When the mobile menu is open, add `overflow-hidden` to the `body` element to prevent double scrollbars

  Open: "fixed inset-0 z-40 overflow-y-auto", Closed: ""
-->

@props(['inputTransparent' => false])

<header {{ $attributes->merge(["class" => "shadow-sm lg:overflow-y-visible"]) }} data-controller="dropdown">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative flex justify-between lg:gap-8 xl:grid xl:grid-cols-12">
            <div class="flex md:absolute md:inset-y-0 md:left-0 lg:static xl:col-span-2">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="h-7 w-auto text-primary-600"/>
                    </a>
                </div>
            </div>
            <div class="min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-6">
                <div class="flex items-center px-6 py-4 md:mx-auto md:max-w-3xl lg:mx-0 lg:max-w-none xl:px-0">
                    <form method="GET" action="{{ route('movies.search') }}" class="w-full">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="search" name="search" class="@if($inputTransparent) bg-transparent ring-gray-700 text-white @else bg-background ring-gray-200 dark:ring-white/10 text-title @endif block w-full rounded-md dark:ring-gray-700 border-0 py-1.5 pl-10 pr-3 ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-500 dark:focus:ring-primary-500 sm:text-sm sm:leading-6" placeholder="Search a movie" type="search" value="{{ request()->query('search') }}">
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex items-center md:absolute md:inset-y-0 md:right-0 lg:hidden">
                <!-- Mobile menu button -->
                <button type="button" data-action="dropdown#toggleMobileMenu" class="relative -mx-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open menu</span>
                    <!--
                      Icon when menu is closed.

                      Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block h-6 w-6" data-dropdown-target="mobileOpenIcon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
                      Icon when menu is open.

                      Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" data-dropdown-target="mobileCloseIcon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:items-center lg:justify-end xl:col-span-4">
                <!-- Profile dropdown -->
                <div class="relative ml-5 flex-shrink-0">
                    @auth
                        <div>
                            <button type="button" data-action="dropdown#toggle" class="@if($inputTransparent) focus:ring-offset-[#111828] @endif relative flex rounded-full bg-background focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-background" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <x-user-avatar class="h-8 w-8 rounded-full object-cover"/>
                            </button>
                        </div>

                        <div data-dropdown-target="content" class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-background py-1 shadow-lg dark:shadow-gray-500/5 dark:border dark:border-gray-200/10 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="{{ route('profile.index', auth()->user()->username) }}" class="block px-4 py-2 text-sm text-title hover:bg-gray-200 dark:hover:bg-gray-200/10 {{ request()->routeIs('profile.index') ? 'bg-gray-100 dark:bg-gray-100/5' : '' }}" role="menuitem" tabindex="-1">Profile</a>
                            <a href="{{ route('settings.index') }}" class="block px-4 py-2 text-sm text-title hover:bg-gray-200 dark:hover:bg-gray-200/10 {{ request()->routeIs('settings.index') ? 'bg-gray-100 dark:bg-gray-100/5' : '' }}" role="menuitem" tabindex="-1">Settings</a>
                            <form action="{{ route('auth.logout') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="w-full text-start block px-4 py-2 text-sm text-title hover:bg-gray-200 dark:hover:bg-gray-200/10" role="menuitem" tabindex="-1">Sign out</button>
                            </form>
                        </div>
                    @endauth
                </div>

                @guest
                    <x-button href="{{ route('auth.login') }}" class="ml-6" type="secondary">Log in</x-button>
                    <x-button href="{{ route('auth.register') }}" class="ml-6">Sign up</x-button>
                @endguest
                @auth
                    <form action="{{ route('auth.logout') }}" method="post">
                        @method('DELETE')
                        @csrf
                        <x-button type="submit" class="ml-6">Log out</x-button>
                    </form>
                @endauth
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <nav class="lg:hidden hidden" aria-label="Global" data-dropdown-target="mobileMenu">
        <div class="mx-auto max-w-3xl space-y-1 px-2 pb-3 pt-2 sm:px-4">
            <!-- Current: "bg-gray-100 text-gray-900", Default: "hover:bg-gray-50" -->
            <a href="#" aria-current="page" class="bg-gray-100 text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Dashboard</a>
            <a href="#" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">Calendar</a>
            <a href="#" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">Teams</a>
            <a href="#" class="hover:bg-gray-50 block rounded-md py-2 px-3 text-base font-medium">Directory</a>
        </div>
        <div class="border-t border-gray-200 pb-3 pt-4">
            <div class="mx-auto flex max-w-3xl items-center px-4 sm:px-6">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">Chelsea Hagon</div>
                    <div class="text-sm font-medium text-gray-500">chelsea.hagon@example.com</div>
                </div>
                <button type="button" class="relative ml-auto flex-shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>
            </div>
            <div class="mx-auto mt-3 max-w-3xl space-y-1 px-2 sm:px-4">
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-900">Your Profile</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-900">Settings</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-900">Sign out</a>
            </div>
        </div>
    </nav>
</header>
