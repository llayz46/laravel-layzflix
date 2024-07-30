@props(['review'])

<div {{ $attributes->merge(['class' => "flex space-x-4 text-sm text-body"]) }}>
    <div>
        <x-user-avatar class="h-10 w-10 rounded-full bg-gray-100" :user="$review['user']"/>
    </div>
    <div class="flex-none pb-10">
        <h3 class="font-medium text-title">{{ $review['user']['username'] }}</h3>
        <p><time datetime="{{ $review['created_at'] }}">{{ \Carbon\Carbon::createFromDate($review['created_at'])->toFormattedDateString() }}</time></p>

        <div class="mt-4 flex items-center">
            @for($i =0; $i < $review['note']; $i++)
                <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                </svg>
            @endfor
        </div>

        <div class="prose prose-sm mt-4 max-w-none text-body">
            <p>{{ \Illuminate\Support\Str::ucfirst($review['comment']) }}</p>
        </div>

        @auth
            @if($review->user_id === auth()->user()->id)
                <form action="{{ route('review.delete', $review) }}" method="post" class="mt-4">
                    @method('DELETE')
                    @csrf
                    <x-button type="danger">Delete</x-button>
                </form>
            @endif
        @endauth
    </div>
</div>
