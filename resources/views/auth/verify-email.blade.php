<x-layout title="Verify your email" :footer="false">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="bg-background dark:border-white/10 shadow dark:shadow-gray-500/5 sm:rounded-lg w-fit">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-base font-semibold leading-6 text-title">Almost there! Please verify your email.</h3>
                <div class="mt-2 max-w-xl text-sm text-body">
                    <p>Verifying your email address... We've sent an email to the address you provided. Please click the confirmation link in that email to activate your account and access all the features of our site.</p>
                </div>
                <div class="mt-5 flex max-sm:flex-col max-sm:gap-4 sm:justify-between sm:items-end">
                    <form action="{{ route('verification.send') }}" method="post">
                        @csrf
                        <x-button type="submit">{{ \Illuminate\Support\Str::upper('Resend Verification Email') }}</x-button>
                    </form>
                    <form action="{{ route('auth.logout') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-button type="submit-text">Log out</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
