<x-layout title="Edit my profile">
    <x-header/>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <h1 class="text-3xl font-bold leading-tight tracking-tight text-title pt-2">Public profile</h1>
        <section class="container mx-auto max-w-7xl px-6 lg:px-8">
            <x-profile-form
                route="profile.updateInformation"
                method="PATCH"
                form-title="Profile Information"
                :user="$user"
                formDescription="Update the informations of your public profile. This information will be visible to other users."
                fields="1"
                button="Update">
                <div class="sm:col-span-4">
                    <div class="relative">
                        <label for="bio" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">Biographie</label>
                        <x-textarea field="bio" rows="5">{{ $user->bio }}</x-textarea>
                        <div class="mt-2">
                            @error('bio')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </x-profile-form>

            <x-profile-form
                route="profile.updateImage"
                method="POST"
                form-title="Profile Image"
                :file="true"
                :user="$user"
                formDescription="Update your profile avatar."
                fields="1"
                button="Update">
                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <div class="col-span-full">
                            <div class="mt-2 flex justify-center rounded-lg border-dashed border-2 dark:border-gray-200/10 px-6 py-10">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm leading-6 text-body">
                                        <label for="avatar" class="relative cursor-pointer rounded-md font-semibold text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 hover:text-primary-400">
                                            <span>Upload a file</span>
                                            <input id="avatar" name="avatar" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-body">PNG, JPG, SVG up to 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-profile-form>
        </section>
    </div>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <h1 class="text-3xl font-bold leading-tight tracking-tight text-title pt-2">Profile settings</h1>
        <section class="container mx-auto max-w-7xl px-6 lg:px-8">
            <x-profile-form
                route="profile.update"
                method="PATCH"
                form-title="Profile Information"
                formDescription="Update your account's profile information and email address."
                fields="2"
                button="Update">
                <div class="sm:col-span-4">
                    <div class="flex w-full gap-3">
                        <div class="relative w-1/2">
                            <label for="first_name" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">First name</label>
                            <x-input-text required field="first_name" :value="$user->first_name"></x-input-text>
                            <div class="mt-2">
                                @error('first_name')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="relative w-1/2">
                            <label for="last_name" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">Last name</label>
                            <x-input-text required field="last_name" :value="$user->last_name"></x-input-text>
                            <div class="mt-2">
                                @error('last_name')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <div class="relative">
                        <label for="email" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">Email</label>
                        <x-input-text required field="email" :value="$user->email"></x-input-text>
                        <div class="mt-2">
                            @error('email')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <div class="relative">
                        <label for="username" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">Username</label>
                        <x-input-text required field="username" :value="$user->username"></x-input-text>
                        <div class="mt-2">
                            @error('username')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </x-profile-form>

            <x-profile-form
                route="profile.updatePassword"
                method="PUT"
                form-title="Update Password"
                formDescription="Ensure your account is using a long, random password to stay secure."
                fields="3"
                button="Update">
                <div class="sm:col-span-4">
                    <div class="relative">
                        <label for="current_password" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">Current password</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary-500 sm:max-w-md">
                                <x-input-text name="current_password" id="current_password" autocomplete="current-password"
                                              required type="password" autocomplete="new-password" field="current_password">
                                </x-input-text>
                            </div>
                            @error('current_password')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <div class="relative">
                        <label for="new_password" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">New password</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary-500 sm:max-w-md">
                                <x-input-text name="new_password" id="new_password" autocomplete="new_password"
                                              required type="password" field="new_password" placeholder="Must be at least 8 characters.">
                                </x-input-text>
                            </div>
                            @error('new_password')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <div class="relative">
                        <label for="new_password_confirm" class="absolute -top-2 left-2 inline-block bg-background px-1 text-xs font-medium text-title">Confirm new password</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary-500 sm:max-w-md">
                                <x-input-text name="new_password_confirm" id="new_password_confirm"
                                              required type="password" field="new_password_confirm">
                                </x-input-text>
                            </div>
                            @error('new_password_confirm')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </x-profile-form>
        </section>
    </div>

    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mt-8 sm:mt-6">
        <h1 class="text-3xl font-bold leading-tight tracking-tight text-title pt-2">Settings</h1>
        <section class="container mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="space-y-12 mt-10">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 pb-12 md:grid-cols-3">
                        <div>
                            <h2 class="text-base font-semibold leading-7 text-title">Toggle DarkMode</h2>
                            <p class="mt-1 text-sm leading-6 text-body">Choose if you want to use the dark or light theme</p>
                        </div>
                        <div class="flex justify-center items-center">
                            <button type="button" class="bg-gray-200 relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-background" role="switch" data-action="theme#toggle" data-theme-target="button">
                                <span class="translate-x-0 pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" data-theme-target="container">
                                    <span class="opacity-100 duration-200 ease-in absolute inset-0 flex h-full w-full items-center justify-center transition-opacity" aria-hidden="true" data-theme-target="iconDark">
                                        <svg class="h-3 w-3 text-indigo-600" viewBox="0 0 12 12" fill="currentColor">
                                            <path d="M6.48749 11.6624C5.24999 11.6624 4.03124 11.2687 3.03749 10.4999C1.70624 9.48745 0.899994 7.94995 0.806244 6.26245C0.693744 4.2187 1.78124 2.21245 3.54374 1.1437C4.55624 0.543698 5.66249 0.262448 6.82499 0.337448C7.06874 0.356198 7.27499 0.506198 7.34999 0.731198C7.42499 0.956198 7.38749 1.19995 7.21874 1.3687C6.22499 2.36245 5.81249 3.78745 6.11249 5.1562C6.56249 7.19995 8.47499 8.58745 10.5562 8.3812C10.8 8.36245 11.025 8.47495 11.1375 8.6812C11.25 8.88745 11.25 9.1312 11.1 9.3187C10.275 10.4437 9.07499 11.2312 7.70624 11.5312C7.29374 11.6249 6.88124 11.6624 6.48749 11.6624ZM6.24374 1.1812C5.45624 1.2187 4.68749 1.4437 3.97499 1.87495C2.47499 2.77495 1.55624 4.4812 1.64999 6.2062C1.72499 7.64995 2.41874 8.96245 3.54374 9.82495C4.66874 10.6874 6.13124 11.0062 7.51874 10.7062C8.51249 10.4999 9.39374 9.97495 10.0687 9.22495C7.78124 9.2062 5.77499 7.5937 5.26874 5.32495C4.94999 3.86245 5.30624 2.3437 6.24374 1.1812Z"/>
                                        </svg>
                                    </span>

                                    <span class="opacity-0 duration-100 ease-out absolute inset-0 flex h-full w-full items-center justify-center transition-opacity" aria-hidden="true" data-theme-target="iconLight">
                                        <svg class="h-3 w-3 text-indigo-600" fill="currentColor" viewBox="0 0 12 12">
                                            <path d="M5.99995 3.44995C4.5937 3.44995 3.44995 4.5937 3.44995 5.99995C3.44995 7.4062 4.5937 8.54995 5.99995 8.54995C7.4062 8.54995 8.54995 7.4062 8.54995 5.99995C8.54995 4.5937 7.4062 3.44995 5.99995 3.44995ZM5.99995 7.7062C5.06245 7.7062 4.2937 6.93745 4.2937 5.99995C4.2937 5.06245 5.06245 4.2937 5.99995 4.2937C6.93745 4.2937 7.7062 5.06245 7.7062 5.99995C7.7062 6.93745 6.93745 7.7062 5.99995 7.7062Z"/>
                                            <path d="M5.99998 2.11873C6.22498 2.11873 6.43123 1.93123 6.43123 1.68748V0.749976C6.43123 0.524976 6.24373 0.318726 5.99998 0.318726C5.77498 0.318726 5.56873 0.506226 5.56873 0.749976V1.70623C5.58748 1.93123 5.77498 2.11873 5.99998 2.11873Z"/>
                                            <path d="M5.99998 9.88123C5.77498 9.88123 5.56873 10.0687 5.56873 10.3125V11.25C5.56873 11.475 5.75623 11.6812 5.99998 11.6812C6.22498 11.6812 6.43123 11.4937 6.43123 11.25V10.2937C6.43123 10.0687 6.22498 9.88123 5.99998 9.88123Z"/>
                                            <path d="M9.0562 3.37493C9.1687 3.37493 9.2812 3.33743 9.3562 3.24368L9.9562 2.64368C10.125 2.47493 10.125 2.21243 9.9562 2.04368C9.78745 1.87493 9.52495 1.87493 9.3562 2.04368L8.7562 2.64368C8.58745 2.81243 8.58745 3.07493 8.7562 3.24368C8.8312 3.33743 8.9437 3.37493 9.0562 3.37493Z"/>
                                            <path d="M2.66248 8.75621L2.06248 9.33746C1.89373 9.50621 1.89373 9.76871 2.06248 9.93746C2.13748 10.0125 2.24998 10.0687 2.36248 10.0687C2.47498 10.0687 2.58748 10.0312 2.66248 9.93746L3.26248 9.33746C3.43123 9.16871 3.43123 8.90621 3.26248 8.73746C3.09373 8.58746 2.81248 8.58746 2.66248 8.75621Z"/>
                                            <path d="M11.2499 5.58752H10.2937C10.0687 5.58752 9.86243 5.77502 9.86243 6.01877C9.86243 6.24377 10.0499 6.45003 10.2937 6.45003H11.2499C11.4749 6.45003 11.6812 6.26252 11.6812 6.01877C11.6812 5.77502 11.4749 5.58752 11.2499 5.58752Z"/>
                                            <path d="M2.11873 5.99998C2.11873 5.77498 1.93123 5.56873 1.68748 5.56873H0.749976C0.524976 5.56873 0.318726 5.75623 0.318726 5.99998C0.318726 6.22498 0.506226 6.43123 0.749976 6.43123H1.70623C1.93123 6.43123 2.11873 6.22498 2.11873 5.99998Z"/>
                                            <path d="M9.33752 8.7562C9.16877 8.58745 8.90627 8.58745 8.73752 8.7562C8.56877 8.92495 8.56877 9.18745 8.73752 9.3562L9.33752 9.9562C9.41252 10.0312 9.52502 10.0875 9.63752 10.0875C9.75002 10.0875 9.86252 10.05 9.93752 9.9562C10.1063 9.78745 10.1063 9.52495 9.93752 9.3562L9.33752 8.7562Z"/>
                                            <path d="M2.66248 2.06248C2.49373 1.89373 2.23123 1.89373 2.06248 2.06248C1.89373 2.23123 1.89373 2.49373 2.06248 2.66248L2.66248 3.26248C2.73748 3.33748 2.84998 3.39373 2.96248 3.39373C3.07498 3.39373 3.18748 3.35623 3.26248 3.26248C3.43123 3.09373 3.43123 2.83123 3.26248 2.66248L2.66248 2.06248Z"/>
                                        </svg>
                                    </span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layout>
