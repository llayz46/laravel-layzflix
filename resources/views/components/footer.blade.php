<footer class="bg-background">
    <div class="mx-auto max-w-7xl overflow-hidden px-6 py-20 sm:py-24 lg:px-8">
        <nav class="-mb-6 columns-2 sm:flex sm:justify-center sm:space-x-12" aria-label="Footer">
            <div class="pb-6">
                <a href="{{ route('home') }}" class="text-sm leading-6 text-body hover:text-title">Home</a>
            </div>
            @auth
                <div class="pb-6">
                    <a href="{{ route('profile.index', auth()->user()) }}" class="text-sm leading-6 text-body hover:text-title">Profile</a>
                </div>
                <div class="pb-6">
                    <a href="{{ route('settings.index') }}" class="text-sm leading-6 text-body hover:text-title">Settings</a>
                </div>
            @endauth
        </nav>
        <div class="mt-10 flex justify-center space-x-10">
            <a href="https://www.llayz.fr" class="text-body hover:text-title">
                <span class="sr-only">llayz.fr</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12ZM15.1858 4.68748H12.6497C12.3578 4.68748 12.088 4.84187 11.9425 5.09196L3.56186 19.4837H6.10368C6.39224 19.4837 6.65886 19.3317 6.80274 19.0841L15.1858 4.68748ZM19.4452 19.4837H11.3548H8.81295L17.1935 5.09194C17.3391 4.84185 17.6089 4.68745 17.9007 4.68745H20.4369L13.2544 17.0222L19.4468 17.068C19.6525 17.0697 19.8191 17.2353 19.8191 17.4396V19.1138C19.8191 19.318 19.6516 19.4837 19.4452 19.4837Z"/>
                </svg>
            </a>
            <a href="https://github.com/llayz46" class="text-body hover:text-title">
                <span class="sr-only">GitHub</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        <p class="mt-10 text-center text-xs leading-5 text-body">&copy; 2024 llayz, Inc. All rights reserved.</p>
    </div>
</footer>
