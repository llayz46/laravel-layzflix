@props(['file' => false, 'user', 'route', 'method', 'formTitle', 'formDescription', 'profile' => true, 'params' => null, 'button'])

<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <form action="@if($params === null) {{ route($route) }} @else {{ route($route, $params) }} @endif" method="post" @if($file) enctype="multipart/form-data" @endif>
        @csrf
        @method($method)
        <div class="space-y-12 mt-10">
            <div
                class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 dark:border-gray-200/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-title">{{ $formTitle }}</h2>
                    <p class="mt-1 text-sm leading-6 text-body">{{ $formDescription }}</p>
                    @if ($file && $user->avatar)
                        <img class="mt-2 rounded-md w-2/4 size-32 object-cover" src="{{ $user->imageUrl() }}" alt="">
                    @endif
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    {{ $slot }}
                    <div class="sm:col-span-4">
                        <x-button type="submit" class="w-fit">{{ $button }}</x-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
