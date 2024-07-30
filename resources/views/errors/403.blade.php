<x-layout title="Forbidden! You Shall Not Pass!" :footer="false">
    <x-header class="dark:shadow-gray-500/5"/>

    <main class="grid place-items-center px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="font-semibold text-primary-500 text-9xl">403</p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-title sm:text-5xl">Access denied.</h1>
            <p class="mt-6 text-base leading-7 text-body">This page is a bit like a very exclusive club: you're not invited.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <x-button type="primary" :href="route('home')">Go back home</x-button>
            </div>
        </div>
    </main>
</x-layout>
