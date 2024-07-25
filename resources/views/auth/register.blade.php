<x-layout title="Register" :footer="false">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="{{route('home')}}">
                <x-application-logo class="mx-auto h-10 w-auto text-primary-500"></x-application-logo>
            </a>
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-title">Create your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md">
            <form class="flex flex-col gap-6" action="{{ route('auth.register') }}" method="POST">
                @csrf
                <div class="flex w-full gap-3">
                    <div class="relative w-1/2">
                        <label for="first_name" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">First name</label>
                        <x-input-text placeholder="John" value="{{ old('first_name') }}" required :autocomplete="true" field="first_name"></x-input-text>
                        <div class="mt-2">
                            @error('first_name')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="relative w-1/2">
                        <label for="last_name" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">Last name</label>
                        <x-input-text placeholder="Smith" value="{{ old('last_name') }}" required :autocomplete="true" field="last_name"></x-input-text>
                        <div class="mt-2">
                            @error('last_name')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <label for="username" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">Username</label>
                    <x-input-text placeholder="Enter username to display" value="{{ old('username') }}" required :autocomplete="true" field="username"></x-input-text>
                    <div class="mt-2">
                        @error('username')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

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
                    <x-input-text type="password" placeholder="Must be at least 8 characters" required field="password"></x-input-text>
                    <div class="mt-2">
                        @error('password')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="relative">
                    <label for="password_confirmation" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">Confirm password</label>
                    <x-input-text type="password" placeholder="" required field="password_confirmation"></x-input-text>
                    <div class="mt-2">
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <x-button type="submit" class="w-full">Register</x-button>
            </form>

            <p class="mt-10 text-center text-sm text-body">
                Already have an account?
                <a href="{{ route('auth.login') }}" class="font-semibold leading-6 text-primary-500 hover:text-primary-400">Log in here!</a>
            </p>
        </div>
    </div>
</x-layout>
