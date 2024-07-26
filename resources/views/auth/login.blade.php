<x-layout title="Login" :footer="false">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="{{route('home')}}">
                <x-application-logo class="mx-auto h-10 w-auto text-primary-500"></x-application-logo>
            </a>
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-title">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('auth.login') }}" method="POST">
                @csrf
                <div class="relative">
                    <label for="email" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">Email</label>
                    <x-input-text placeholder="john@smith.fr" value="{{ old('email') }}" required :autocomplete="true" field="email"></x-input-text>
                    <div class="mt-2">
                        @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="relative">
                    <label for="password" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">Password</label>
                    <x-input-text required :autocomplete="true" field="password" type="password"></x-input-text>
                    <div class="text-sm text-end mt-1">
                        <a href="#" class="font-semibold text-primary-500 hover:text-primary-400">Forgot password?</a>
                    </div>
                    <div class="mt-2">
                        @error('password')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <x-input-checkbox id="remember_me" name="remember">Remember me</x-input-checkbox>
                    </label>
                </div>

                <x-button type="submit" class="w-full">Sign in</x-button>
            </form>

            <p class="mt-10 text-center text-sm text-body">
                No account yet?
                <a href="{{ route('auth.register') }}" class="font-semibold leading-6 text-primary-500 hover:text-primary-400">Register Now!</a>
            </p>
        </div>
    </div>
</x-layout>
